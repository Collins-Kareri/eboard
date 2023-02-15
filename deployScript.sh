#!/bin/bash

NC='\033[0m'
RED='\033[1;91m'
GREEN='\033[1;92m'
YELLOW='\033[1;93m'
BLUE='\033[1;94m'
AMAZON_LINUX_PATH=/aws/service/ami-amazon-linux-latest/amzn2-ami-hvm-x86_64-gp2
PRIMARY_AZ=us-west-2a
SECONDARY_AZ=us-west-2b

# todo check if resource exists before creating

# check if aws cli is installed
if ! command -v aws &>/dev/null; then
    echo -e "\n${RED}*** PLEASE INSTALL AWS CLI. ***${NC}\n"
    exit
fi

notify() {
    case $1 in
    error)
        echo -e "\n${RED}*** Falied: $2 ***${NC}\n" >&2
        ;;
    info)
        echo -e "${BLUE}$2....${NC}" >&2
        ;;
    warning)
        echo -e "\n${YELLOW} $2 ${NC}" >&2
        ;;
    success)
        echo -e "\t${GREEN} $2 ${NC}" >&2
        ;;
    esac
}

handleErrors() {
    if [ $? -eq 0 ]; then
        notify "success" $1
    else
        notify "error" $2
    fi
}

notify 'warning' 'This script use aws cli, please make sure it is configured'

read -p "Choose a name for your vpc: " vpc_name
# read -p "Enter a cidr block: " cidr_block

notify 'info' 'Creating vpc'

vpc_id=$(aws ec2 create-vpc --region us-west-2 --cidr-block 10.0.0.0/26 --tag-specification "ResourceType=vpc,Tags=[{Key=Name,Value=$vpc_name}]" --query Vpc.VpcId --output text)

# function to create subnets, it returns a subnet id
createSubnet() {
    echo $(aws ec2 create-subnet --vpc-id $vpc_id --availability-zone $1 --cidr-block $2 --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=$3}]" --query Subnet.SubnetId --output text)
}

notify 'info' 'Creating subnets'
# create public subnets

public_subnet_1_id=$(createSubnet $PRIMARY_AZ 10.0.0.0/28 public_subnet1)
public_subnet_2_id=$(createSubnet $SECONDARY_AZ 10.0.0.16/28 public_subnet2)

# create private subnets

private_subnet_1_id=$(createSubnet $PRIMARY_AZ 10.0.0.32/28 private_subnet1)
private_subnet_2_id=$(createSubnet $SECONDARY_AZ 10.0.0.48/28 private_subnet2)

notify 'info' 'Creating internet gateway'
# create internet gateway
my_IGW=$(aws ec2 create-internet-gateway --tag-specification "ResourceType=internet-gateway,Tags=[{Key=Name,Value="${vpc_name}_IGW"}]" --query InternetGateway.InternetGatewayId --output text)

notify 'info' 'Attaching internet gateway to vpc'
aws ec2 attach-internet-gateway --vpc-id $vpc_id --internet-gateway-id $my_IGW
notify 'success' 'Attached'

# function to create route tables, returns route table id
create_route_table() {
    echo $(aws ec2 create-route-table --vpc-id $vpc_id --tag-specification "ResourceType=route-table,Tags=[{Key=Name,Value=$1}]" --query RouteTable.RouteTableId --output text)
}

# variable to hold public route table id
public_RT=$(create_route_table public_RT)

notify 'info' 'Adding rule to allow internet access to vpc using internet gateway'
__unused=$(aws ec2 create-route --route-table-id $public_RT --destination-cidr-block 0.0.0.0/0 --gateway-id $my_IGW 2>/dev/null)
handleErrors "Rule added, public route table is now associated with internet gateway" "internet gateway not associated with public route table"

# function for associating subnet with a route table
associateRouteTable() {
    result=$(aws ec2 associate-route-table --subnet-id $1 --route-table-id $2 --query "AssociationState"."State" --output text)
    notify "success" $result
}

#function for modifying a subnet to assign public ips
modifySubnet() {
    aws ec2 modify-subnet-attribute --subnet-id $1 --map-public-ip-on-launch
}

notify 'info' 'Associating public subnets with public route table'

associateRouteTable $public_subnet_1_id $public_RT
associateRouteTable $public_subnet_2_id $public_RT

notify 'info' 'Changing public subnet to assign public ips'

modifySubnet $public_subnet_1_id
modifySubnet $public_subnet_2_id

notify 'info' 'Creating private route table'
# variable to hold private route table id
private_RT=$(create_route_table private_RT)

notify 'info' 'Associating private subnets with private route table'

associateRouteTable $private_subnet_1_id $private_RT
associateRouteTable $private_subnet_2_id $private_RT

notify 'success' 'Done with vpc elements'

# create a security group for ec2-instance and store it's id
read -p "Choose a name for your ec2 security group: " group_name

notify 'info' 'Creating security group'

web_server_sg_id=$(aws ec2 create-security-group --group-name $group_name --description "webserver SG" --vpc-id $vpc_id --tag-specification "ResourceType=security-group,Tags=[{Key=Name,Value=$group_name}]" --query "GroupId" --output text)

notify 'info' 'Adding ssh rule to web server security group'

__unused=$(aws ec2 authorize-security-group-ingress --group-id $web_server_sg_id --protocol tcp --port 22 --cidr 0.0.0.0/0)

handleErrors "Added, ssh now allowed from any ip." "couldn't add the inbound rule."

# create a key pair for ssh
askForKeyName() {
    read -p "Enter a preferred key pair name (this is used to facilitate ssh connections): " res
    echo $res
}

check_keypair() {
    notify "info" "Checking if keypair already exists"
    aws ec2 describe-key-pairs --key-name $1 --query "KeyPairs"[0]."KeyName" --output text 2>/dev/null

    if [ $? -eq 0 ]; then
        notify "warning" "Keypair found"
        key_status=$(doOrNot 'Use this as your key pair name')
        if [[ $key_status == 'N' || $key_status == 'n' ]]; then
            create_keypair "y"
        fi
    else
        notify "info" "Keypair not found"
        key_status=$(doOrNot 'Would you like to create a new one')
        create_keypair $key_status $1
    fi
}

create_keypair() {
    if [[ $1 == 'Y' || $1 == 'y' ]]; then
        local key_name=$2

        while [ -z $key_name ]; do
            local key_name=$(askForKeyName)
        done

        notify "info" "Creating keypair"
        aws ec2 create-key-pair --key-name $key_name --query 'KeyMaterial' --output text >$key_name.pem
        notify "success" "Done. Check current folder for $key_name.pem"
    fi
}

doOrNot() {
    read -p "$1? (Y/N)" res
    echo $res
}

key_name=$(askForKeyName)
key_status=$(check_keypair $key_name)

# create webserver logic
read -p "Please enter prefered instance name: " instance_name

notify "info" "Creating instance"

web_server_id=$(aws ec2 run-instances --image-id resolve:ssm:$AMAZON_LINUX_PATH --count 1 --instance-type t3.nano --associate-public-ip-address --key-name $key_name --security-group-ids $web_server_sg_id --subnet-id $public_subnet_1_id --tag-specification "ResourceType=instance,Tags=[{Key=Name,Value=$instance_name}]" --query Instances[0].InstanceId --output text)

if [ -z $web_server_id ]; then
    notify "error" "Couldn't create instance"
    exit 0
fi

notify "info" "Starting instance"
aws ec2 wait instance-running --instance-ids $web_server_id

notify "info" "Checking instance status"
aws ec2 wait instance-status-ok --instance-ids $web_server_id
notify "success" "Instance status is ok"
notify "success" "Done."
