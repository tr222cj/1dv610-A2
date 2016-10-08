#!/bin/bash

echo "Provisioning virtual machine..."

echo "Installing Updates"
sudo apt-get update -y > /dev/null

echo "Installing Nginx"
sudo apt-get install -y nginx > /dev/null

echo "Redirecting folders"
sudo rm -rf /var/www/html
sudo ln -fs /vagrant/exercise /var/www/html

echo "Configuring Nginx"
sudo cp /vagrant/.provision/config/localhost /etc/nginx/sites-available/localhost > /dev/null
sudo rm -rf /etc/nginx/sites-enabled/localhost
sudo ln -s /etc/nginx/sites-available/localhost /etc/nginx/sites-enabled/
sudo rm -rf /etc/nginx/sites-available/default
sudo service nginx restart > /dev/null

echo "Preparing MySQL"
apt-get install debconf-utils -y > /dev/null
debconf-set-selections <<< "mysql-server mysql-server/root_password password test"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password test"

echo "Installing MySQL"
sudo apt-get install -y mysql-server > /dev/null

echo "Installing PHP"
sudo apt-get install -y php-fpm php-mysql > /dev/null

echo "All done!"
