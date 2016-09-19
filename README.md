# Login_1DV610
Interface repository for 1DV610 assignment 2 and 4

#TEST SERVER
I used vagrant and the box `bento/ubuntu-16.04`.

#PREPARE YOUR SERVER
https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04

## INSTALL PDO
check phpinfo();
```php
<?php
phpinfo();
```

If PDO is not installed, install it:  
`sudo apt-get install php7.0-mysql`

## CONFIG
Add APP_ENV to nginx on your test server:  
`location / {
    fastcgi_param APP_ENV test;
}`

#CREATE DATABASE
You must manually create a database:  
https://www.liquidweb.com/kb/create-a-mysql-database-on-linux-via-command-line/

`mysql -u [sql_user] -p`

```sql
CREATE DATABASE test_db; -- Give it any name, just make sure you set the name in config.
```

You must manually create a table user:

```sql
SHOW DATABASES;
```

```sql
USE [name_of_database];
```

```sql
CREATE TABLE AppUser (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),
    password varchar(100)
);
```

```sql
INSERT INTO AppUser (username, password)
VALUES (PreDefinedUserName, PreDefinedPassword);
```

##RESOURCES
https://phpdelusions.net/pdo

#MANUAL LABOUR
You must manually copy existing/create new folder data/ with two files after cloning this repo: test.php & production.php  
Can can also specify optional settings else defaults will be used:

```php
<?php

return [
    'host' => '127.0.0.1',
    'db' => '1dv610_a2_login',
    'user' => 'AppUser',
    'pass' => 'Pass!Word',
    'charset' => 'utf8',
    'exceptions' => PDO::ERRMODE_SILENT,
    // Optional below
    'hash-algo' => PASSWORD_BCRYPT,
    'hash-options' => [
        'cost' => 10,
    ],
];
```

