<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Require logic
require_once('./core/Session.php');
require_once('./core/View.php');
require_once('./core/Database.php');

// Get controller from query string
if (empty($_SERVER['QUERY_STRING'])) {
    $controller = 'login';
} else {
    $controller = explode('=', $_SERVER['QUERY_STRING'])[0];
}

// Start new or resume existing session
Session::start();

// Routes
switch ($controller) {
    case 'login':
        Session::set('action', 'login');
        require_once('./controller/LoginController.php');
        $controller = new LoginController();
        break;
    case 'register':
        Session::set('action', 'register');
        require_once('./controller/RegisterController.php');
        $controller = new RegisterController();
        break;
    default:
        echo 'To bad. You did something wrong :(';
        break;
}