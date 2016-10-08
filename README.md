# Login_1DV610
Interface repository for 1DV610 assignment 2 and 4

#TEST SERVER
I use vagrant. All you have to do is clone this project and run

```
vagrant up
```

All the settings will be done for you, except creation of database, look below for that.

For more information about the vagrant box see: https://github.com/tr222cj/vagrant-lemp-mvc-box

#CREATE DATABASE
You must manually create a database:  
https://www.liquidweb.com/kb/create-a-mysql-database-on-linux-via-command-line/

```
vagrant ssh
```

```
mysql -u sql_user -p
```

```sql
CREATE DATABASE test_db;

USE test_db;

CREATE TABLE AppUser (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),
    password varchar(100),
    token varchar(256),
    sessionId varchar(50),
    ip varchar(50),
    browser varchar(512)
);
```

#RESOURCES
https://phpdelusions.net/pdo  
https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet

#PRODUCTION
You must manually create setting Setting.prod.php. See Setting.test.php information
about available settings.  
