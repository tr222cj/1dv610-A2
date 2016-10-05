<?php
declare (strict_types = 1);

// Require Config first
require_once('./core/Config.php');

if (\core\Config::isTestEnvironment()) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

\core\Config::requireEnvironmentSettings();

// Require logic
require_once('./core/Application.php');

new \core\Application();
