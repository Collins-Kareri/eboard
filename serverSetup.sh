#!/bin/bash

user=''
password=''
host=''
db_name=''

sudo yum update -y
# install project dependencies
sudo amazon-linux-extras install php8.0 mariadb10.5 -y
sudo yum install httpd git -y

# start mariadb
sudo systemctl start mariadb.service
sudo systemctl enable mariadb.service

# configure apache server
sudo systemctl start httpd
sudo systemctl enable httpd

# add ec2-user to apache group
sudo usermod -a -G apache ec2-user

# change ownership of var folder and www folder
sudo chown -R ec2-user:apache /var/www
sudo chmod 2775 /var/www

# change permissions of var folder and www folder
find /var/www -type d -exec sudo chmod 2775 {} \;
find /var/www -type f -exec sudo chmod 0664 {} \;

cd /var/www/html
# rm default apache page
rm -rfv index.html

git clone --branch prod https://github.com/Collins-Kareri/employees_capstone_project.git

# move files from cloned folder to server html folder
mv employees_capstone_project/* .

rm -rfv employees_capstone_project

# setup the database
mysql -host="$host" --user="$user" --password="$password" -P 3306 < ProjectDB.sql

# function which takes value to replace in the database config file and value to replace with.
file_path='config/database.php'

editFile() {
    sed -i "s/$1/$2/g" $file_path
}

editFile "yourhost" "${host}"
editFile "youruser" "${user}"
editFile "yourpassword" "${password}"
editFile "yourdatabase" "${db_name}"
