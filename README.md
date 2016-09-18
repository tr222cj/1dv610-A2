# Login_1DV610
Interface repository for 1DV610 assignment 2 and 4

#PREPARE SERVER
https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04

## INSTALL PDO
check phpinfo();
If PDO is not installed, install it:
sudo apt-get install php7.0-mysql

## CONFIG
Add APP_ENV to nginx:
location / {
    fastcgi_param APP_ENV production;
}

#CREATE DATABASE
You must manually create a database: 
https://www.liquidweb.com/kb/create-a-mysql-database-on-linux-via-command-line/

You must manually create a table user:
mysql -u root -p

CREATE DATABASE test_db; -- Give it any name, just make sure you set the name in config.

SHOW DATABASES;

USE [name_of_database];

CREATE TABLE AppUser (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),
    password varchar(100)
);

INSERT INTO AppUser (username, password)
VALUES (PreDefinedUserName, PreDefinedPassword);

##RESOURCES
https://phpdelusions.net/pdo

#MANUAL LABOUR
You must manually copy existing/create new folder data/* with files after cloning this repo.

test.php & production.php

<?php

return [
    'host' => 'IP#',
    'db' => 'DatabaseName',
    'user' => 'UserName',
    'pass' => 'Password',
    'charset' => 'utf8',
];