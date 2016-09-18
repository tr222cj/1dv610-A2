<?php

/**
 * Class UserModel
 */
class UserModel
{
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

        $database = Database::getDatabase();

        if (isset($database[$username])) {
            return $database[$username];
        } else {
            return null;
        }
    }

    public static function registerUser($username, $password) {
        $database = Database::getDatabase();
        $database[$username] = $password;

        return Database::saveDatabase($database);
    }
}