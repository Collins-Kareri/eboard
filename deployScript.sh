#!/bin/bash

NC='\033[0m'     
RED='\033[1;91m'     
GREEN='\033[1;92m'     
YELLOW='\033[1;93m'     
BLUE='\033[1;94m'

# check if aws cli is installed
if ! command -v aws &> /dev/null
then
    echo -e "\n${RED}*** PLEASE INSTALL AWS CLI. ***${NC}\n"
    exit
fi

echo -e "\n${YELLOW}This script use aws cli, please make sure it is configured.${NC}\n"

read -p "Choose a name for your vpc: " vpc_name
# read -p "Enter a cidr block: " cidr_block

echo -e "\n${BLUE}Creating vpc....${NC}"

vpc_id=$(aws ec2 create-vpc --region us-west-2 --cidr-block 10.0.0.0/26 --tag-specification "ResourceType=vpc,Tags=[{Key=Name,Value=$vpc_name}]" --query Vpc.VpcId --output text)

# function to create subnets and return subnet id
createSubnet(){
    echo $(aws ec2 create-subnet --vpc-id $vpc_id --availability-zone $1 --cidr-block $2 --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=$3}]" --query Subnet.SubnetId --output text)
}

echo -e "${BLUE}Creating subnets....${NC}"

# create public subnets

public_subnet_1=$(createSubnet us-west-2a 10.0.0.0/28 public_subnet1) 
public_subnet_2=$(createSubnet us-west-2b 10.0.0.16/28 public_subnet2)

# create private subnets

private_subnet_1=$(createSubnet us-west-2a 10.0.0.32/28 private_subnet1) 
private_subnet_2=$(createSubnet us-west-2b 10.0.0.48/28 private_subnet2)

echo -e "${BLUE}Creating internet gateway....${NC}"

# create internet gateway
my_IGW=$(aws ec2 create-internet-gateway --query InternetGateway.InternetGatewayId --output text)

echo -e "${BLUE}Attaching internet gateway to vpc: $vpc_id.....${NC}"
aws ec2 attach-internet-gateway --vpc-id $vpc_id --internet-gateway-id $my_IGW
echo -e "${GREEN}Attached successfully.${NC}"

# function to create route tables
create_route_table(){
    echo $(aws ec2 create-route-table --vpc-id $vpc_id --tag-specification "ResourceType=route-table,Tags=[{Key=Name,Value=$1}]" --query RouteTable.RouteTableId --output text)
}

# variable to hold public route table id
public_RT=$(create_route_table public_RT)

echo -e "${BLUE}Adding rule to allow internet access to vpc using internet gateway....${NC}"

aws ec2 create-route --route-table-id $public_RT --destination-cidr-block 0.0.0.0/0 --gateway-id $my_IGW

echo -e "${GREEN}Success.${NC}"

# function for associating subnet with a route table
associateRouteTable(){
    aws ec2 associate-route-table --subnet-id $1 --route-table-id $2
}

#function for modifying a subnet to assign public ips
modifySubnet(){
    aws ec2 modify-subnet-attribute --subnet-id $1 --map-public-ip-on-launch
}

echo -e "${BLUE}Associating public subnets with public route table....${NC}"
associateRouteTable $public_subnet_1 $public_RT
associateRouteTable $public_subnet_2 $public_RT

echo -e "${BLUE}Changing public subnet to assign public ips....${NC}"
modifySubnet $public_subnet_1
modifySubnet $public_subnet_2
echo -e "${GREEN}Done.${NC}"

echo -e "${BLUE}Creating private route table....${NC}"
# variable to hold private route table id
private_RT=$(create_route_table private_RT)

echo -e "${BLUE}Associating private subnets with public route table....${NC}"
associateRouteTable $private_subnet_1 $private_RT
associateRouteTable $private_subnet_2 $private_RT

echo -e "${GREEN}Done with vpc elements.${NC}"