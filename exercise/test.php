<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('zend.assertions', 1);

require_once('./setting/Setting.test.php');
require_once('./core/DatabaseFactory.php');

require_once('./model/UserModel.php');
require_once('./test/UserTest.php');

new UserTest();
