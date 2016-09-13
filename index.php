<?php

// Require Authentication logic
require_once('./core/Authenticate.php');

// Get controller from query string
if (empty($_SERVER['QUERY_STRING'])) {
    $controller = 'login';
} else {
    $controller = explode('=', $_SERVER['QUERY_STRING'])[0];
}

// Routes
switch ($controller) {
    case 'login':
        require_once('./controller/LoginController.php');
        $controller = new LoginController();
        break;
    /*
    default:
        require_once('./controller/ErrorController.php');
        $controller = new ErrorController();
        break;
    */
}

// Render the main layout
require_once('./view/LayoutView.php');
