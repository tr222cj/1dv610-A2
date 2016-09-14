<?php

class UserModel
{
    private static $database = [
        "Admin" => "Password",
    ];

    public static function getUser($username) {
        return self::$database[$username];
    }
}