<?php
declare (strict_types = 1);

// Require Config first
require_once('./core/Tool.php');

use core\Tool;

// Only show errors while in test environment
if (Tool::isTestEnvironment()) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

// Require settings based on current environment
if (Tool::isTestEnvironment()) {
    require_once('./setting/Setting.test.php');
} else {
    require_once('./setting/Setting.prod.php');
}

// Start the application
require_once('./core/Application.php');

new \core\Application();
