<?php

class Config {

    private static $config;

    public static function isTestEnvironment() {
        return getenv('APP_ENV') === 'test';
    }

    public static function getConfig($name) {
        // Could not use require_once since that returns TRUE if the file is already loaded.
        // Instead I check if $config is set and if not then require the files.
        if (!self::$config) {
            if (self::isTestEnvironment()) {
                self::$config = require('./data/test.php');
            } else {
                self::$config = require('./data/production.php');
            }
        }

        if (array_key_exists($name, self::$config)) {
            return self::$config[$name];
        }

        return null;
    }
}