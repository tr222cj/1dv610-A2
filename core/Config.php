<?php
declare (strict_types = 1);

class Config {

    private static $config;

    /**
     * @return bool
     */
    public static function isTestEnvironment() : bool {
        return getenv('APP_ENV') === 'test';
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function getConfig(string $key) {
        // Could not use require_once since that returns TRUE if the file is already loaded.
        // Instead I check if $config is set and if not then require the files.
        if (!self::$config) {
            if (self::isTestEnvironment()) {
                self::$config = require('./data/test.php');
            } else {
                self::$config = require('./data/production.php');
            }
        }

        if (array_key_exists($key, self::$config)) {
            return self::$config[$key];
        }

        return null;
    }
}