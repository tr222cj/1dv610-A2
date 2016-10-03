<?php

namespace settings;

abstract class Setting {
    const DB_HOST = "127.0.0.1";
    const DB_NAME = "test_db";
    const DB_USER = "root";
    const DB_PASSWORD = "test";
    const DB_CHARSET = "utf8";
    const DB_ERROR_MODE = \PDO::ERRMODE_EXCEPTION;

    const HASH_ALGORITHM = PASSWORD_BCRYPT;
    const HASH_OPTIONS = [
        'cost' => 10,
    ];

    const COOKIE_SECRET = 'Shhhhhhh! It\'s a secret';

    const TIMEZONE = "Europe/Stockholm";
}
