<?php
declare (strict_types = 1);

namespace core;

final class Config {

    /**
     * @return bool
     */
    public static function isTestEnvironment() : bool {
        return getenv('APPLICATION_ENV') === 'test';
    }

    public static function requireEnvironmentSettings() {
        if (self::isTestEnvironment()) {
            require_once('./setting/Setting.test.php');
        } else {
            require_once('./setting/Setting.prod.php');
        }
    }
}
