<?php

/**
 * Class UserModel
 */
class UserModel
{
    /** @var array Dummy in-memory database */
    private static $database = [
        "Admin" => "Password",
    ];

    /**
     * Gets user from database by username
     * @param string $username Username
     * @return mixed A user or null if username does not exist
     * @throws Exception If username is empty
     */
    public static function getUser($username) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        return self::$database[$username];
    }

    public static function registerUser($username, $password) {
        try {
            self::$database[$username] = $password;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}