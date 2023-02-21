#!/bin/bash

NC='\033[0m'
RED='\033[1;91m'
GREEN='\033[1;92m'
YELLOW='\033[1;93m'
BLUE='\033[1;94m'

notify() {
	case $1 in
	error)
		echo -e "\n${RED}*** Falied: $2 ***${NC}\n" >&2
		;;
	info)
		echo -e "${BLUE}$2${NC}" >&2
		;;
	warning)
		echo -e "${YELLOW} $2 ${NC}" >&2
		;;
	success)
		echo -e "${GREEN} $2 ${NC}" >&2
		;;
	esac
}

checkDep() {
	if ! command -v $1 &>/dev/null; then
		notify "error" "PLEASE INSTALL $1"
		exit
	fi
}

handleErrors() {
	if [ $? -eq 0 ]; then
		notify "success" "$1"
	else
		notify "error" "$2"
		exit 0
	fi
}

readInput() {
	read -e -p "$(echo -e '\b') $1" result
	echo "$result"
}

# check if aws and localstack cli is installed
checkDep aws

# path to latest amazon linux ami image
AMAZON_LINUX_PATH=/aws/service/ami-amazon-linux-latest/amzn2-ami-hvm-x86_64-gp2

notify 'warning' '\nThis script use aws cli, please make sure it is configured\b'

notify "info" "Preparing script"
default_region=$(aws ec2 describe-availability-zones --query 'AvailabilityZones[0].[RegionName]' --output text)

# get availability
primary_az=$(aws ec2 describe-availability-zones --region $default_region --query "AvailabilityZones"[0]."ZoneName" --output text)

secondary_az=$(aws ec2 describe-availability-zones --region $default_region --query "AvailabilityZones"[1]."ZoneName" --output text)

notify "info" "Starting"

vpc_name=$(readInput "Choose a name for your vpc: ")

# read -p "Enter a cidr block: " cidr_block

notify 'info' 'Creating vpc'

vpc_id=$(aws ec2 create-vpc --cidr-block 10.0.0.0/26 --tag-specification "ResourceType=vpc,Tags=[{Key=Name,Value=$vpc_name}]" --query Vpc.VpcId --output text)

# function to create subnets, it returns a subnet id
createSubnet() {
	echo $(aws ec2 create-subnet --vpc-id $vpc_id --cidr-block $1 --availability-zone $2 --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=$3}]" --query Subnet.SubnetId --output text)
}

notify 'info' 'Creating subnets'

# create public subnets
public_subnet_1_id=$(createSubnet 10.0.0.0/28 "$primary_az" public_subnet1)
public_subnet_2_id=$(createSubnet 10.0.0.16/28 "$primary_az" public_subnet1)

# create private subnets
private_subnet_1_id=$(createSubnet 10.0.0.32/28 "$primary_az" private_subnet1)
private_subnet_2_id=$(createSubnet 10.0.0.48/28 "$secondary_az" private_subnet2)

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
handleErrors 'Rule added, public route table is now associated with internet gateway' 'internet gateway not associated with public route table'

# function for associating subnet with a route table

associateRouteTable() {
	result=$(aws ec2 associate-route-table --subnet-id $1 --route-table-id $2 2>/dev/null)
	handleErrors "associated" "failed"
}

# function for modifying a subnet to assign public ips
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

security_group_name=$(readInput "Choose a name for your ec2 security group: ")

notify 'info' 'Creating security group'

web_server_sg_id=$(aws ec2 create-security-group --group-name $security_group_name --description "webserver SG" --vpc-id $vpc_id --tag-specification "ResourceType=security-group,Tags=[{Key=Name,Value=$security_group_name}]" --query "GroupId" --output text)

notify 'info' 'Adding ssh rule to web server security group'
__unused=$(aws ec2 authorize-security-group-ingress --group-id $web_server_sg_id --protocol tcp --port 22 --cidr 0.0.0.0/0)
handleErrors 'Added, you can now ssh' 'could not add the inbound rule.'

notify 'info' 'Adding http rule to web server security group'
__unused=$(aws ec2 authorize-security-group-ingress --group-id $web_server_sg_id --protocol tcp --port 80 --cidr 0.0.0.0/0)
handleErrors 'Added, you can now connect to server through internet' 'could not add the inbound rule'

# create a key pair for ssh
askForKeyName() {
	res=$(readInput "Enter a preferred key pair name (this is used to facilitate ssh connections): ")
	echo $res
}

check_keypair() {
	notify "info" "Checking if keypair already exists"
	aws ec2 describe-key-pairs --key-name $1 --query "KeyPairs"[0]."KeyName" --output text 2>/dev/null

	if [ $? -eq 0 ]; then
		notify "warning" "Keypair found"
		key_status=$(doOrNot 'Use this keypair')

		if [[ $key_status == 'N' || $key_status == 'n' ]]; then
			notify "info" "Enter a new keypair name below"
			create_keypair
		fi

	else
		notify "info" "Keypair not found"
		notify "info" "Proceeding to create keypair"
		create_keypair $1
	fi
}

create_keypair() {
	local key_name=$1
	while [ -z $key_name ]; do
		local key_name=$(askForKeyName)
	done
	notify "info" "Creating keypair"
	aws ec2 create-key-pair --key-name $key_name --query 'KeyMaterial' --output text >$key_name.pem
	notify "success" "Done. Check current folder for ./$key_name.pem"
}

doOrNot() {
	res=$(readInput "$1? (Y/n)")
	echo $res
}

key_name=$(askForKeyName)
key_status=$(check_keypair $key_name)

# create webserver logic

instance_name=$(readInput "Please enter prefered web server instance name: ")

notify "info" "Creating instance"

web_server_id=$(aws ec2 run-instances --image-id resolve:ssm:$AMAZON_LINUX_PATH --count 1 --instance-type t3.nano --associate-public-ip-address --key-name $key_name --security-group-ids $web_server_sg_id --subnet-id $public_subnet_1_id --tag-specification "ResourceType=instance,Tags=[{Key=Name,Value=$instance_name}]" --query Instances[0].InstanceId --output text 2>/dev/null)

handleErrors "created" "Couldn't create instance"

notify "info" "Starting instance"
aws ec2 wait instance-running --instance-ids $web_server_id

notify "info" "Waiting for instance to start"
aws ec2 wait instance-status-ok --instance-ids $web_server_id
notify "success" "Instance status is ok"

db_security_group_name=$(readInput "Choose a name for your database security group: ")

notify 'info' 'Creating db security group'

db_sg_id=$(aws ec2 create-security-group --group-name $db_security_group_name --description "database SG" --vpc-id $vpc_id --tag-specification "ResourceType=security-group,Tags=[{Key=Name,Value=$db_security_group_name}]" --query "GroupId" --output text)

notify 'info' 'Adding database access rule to db security group'
__unused=$(aws ec2 authorize-security-group-ingress --group-id "$db_sg_id" --protocol tcp --port 3306 --source-group "$web_server_sg_id" 2>/dev/null)
handleErrors 'Added, you can now connect to db' 'could not add the inbound rule.'

db_subnet_group_name=$(readInput "Choose a subnet group name: ")
notify "info" "creating subnet group...."
__unused=$(aws rds create-db-subnet-group --db-subnet-group-name "$db_subnet_group_name" --db-subnet-group-description "subnet group for main database" --subnet-ids "$private_subnet_1_id" "$private_subnet_2_id" --query "DBSubnetGroup"."DBSubnetGroupName" --output text)
notify "success" "created"

db_instance_name=$(readInput "Enter desired db instance name: ")
db_name=$(readInput "Enter the name of the database: ")
db_username=$(readInput "Choose a db master username: ")
db_password=$(readInput "Choose a db master password: ")

notify "info" "Defaulting to mysql as database engine"
notify "info" "Creating database instance...."
db_arn=$(aws rds create-db-instance --db-name "$db_name" --db-instance-identifier "$db_instance_name" --db-instance-class db.t3.micro --engine mysql --master-username "$db_username" --master-user-password "$db_password" --allocated-storage 20 --db-subnet-group-name "$db_subnet_group_name" --vpc-security-group-ids "$db_sg_id" --no-multi-az --no-publicly-accessible --query "DBInstance"."DBInstanceArn" --output text)
handleErrors 'Created db instance' 'could not create database instance'

notify "info" "Database instance starting...."
aws rds wait db-instance-available --db-instance-identifier "$db_arn"
notify "success" "started"

notify "info" "Retrieving database instance host endpoint"

# get the db instance host endpoint

db_host=$(aws rds describe-db-instances --db-instance-identifier ${db_arn} --query 'DBInstances[0].Endpoint.Address' --output text)

# setup the webserver

web_server_Ip=$(aws ec2 describe-instances --instance-ids $web_server_id --query "Reservations"[0]."Instances"[0]."PublicIpAddress" --output text)

# changing the pem key to read only
file_path='serverSetup.sh'

editFile() {
    sed -i "s/$1/$2/g" $file_path
}

# add database values to server setup script
editFile "host=''" "host='${db_host}'"
editFile "user=''" "user='${db_username}'"
editFile "password=''" "password='${db_password}'"
editFile "db_name=''" "db_name='${db_name}'"

chmod 400 -v "./$key_name.pem"

# setup webserver
ssh -i "./$key_name.pem" ec2-user@$web_server_Ip 'bash -s'<serverSetup.sh

# returning the pem file to read and write
chmod 600 -v "./$key_name.pem"

# return database values to defaults
editFile "host='${db_host}'" "host=''"
editFile "user='${db_username}'" "user=''"
editFile "password='${db_password}'" "password=''"
editFile "db_name='${db_name}'" "db_name=''"

echo "success" "visit http://${web_server_Ip} to see your website"

echo "{\"public_subnet_1_id\": \"$public_subnet_1_id\", \"private_subnet_1_id\": \"$private_subnet_1_id\", \"private_subnet_2_id\": \"$private_subnet_2_id\", \"vpc_id\": \"$vpc_id\", \"web_server_sg_id\": \"$web_server_sg_id\", \"web_server_id\": \"$web_server_id\", \"public_rt\":\"$public_RT\", \"db_host\":\"$db_host\",\"ip\":\"$web_server_Ip\"}" >vpc_values.json
