<?php
declare (strict_types = 1);

namespace setting;

final class Setting {

    private function __construct() {
        // EMPTY: Private construct prevents initialization
    }

    // Database settings
    const DB_HOST = "127.0.0.1";
    const DB_NAME = "test_db";
    const DB_USER = "root";
    const DB_PASSWORD = "test";
    const DB_CHARSET = "utf8";
    const DB_ERROR_MODE = \PDO::ERRMODE_EXCEPTION;

    // Hash settings
    const HASH_ALGORITHM = PASSWORD_BCRYPT;
    const HASH_OPTIONS = [
        'cost' => 10,
    ];

    // Cookie settings
    const COOKIE_SECRET = 'Shhhhhhh! It\'s a secret';

    // Date settings
    const TIMEZONE = "Europe/Stockholm";
}
