<?php

// Require logic
require_once('./core/Session.php');

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
        require_once('./controller/LoginController.php');
        $controller = new LoginController();
        $controller->render();
        break;
    /*
    default:
        require_once('./controller/ErrorController.php');
        $controller = new ErrorController();
        break;
    */
}