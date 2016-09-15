<?php

class UserModel
{
    /**
     * @access private
     * @static static var
     * @var array Dummy in-memory database
     */
    private static $database = [
        "Admin" => "Password",
    ];

    /**
     * @access public
     * @static static method
     * @param string $username username
     * @return mixed A user or null if username does not exist
     * @throws Exception If username is empty
     */
    public static function getUser($username) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        return self::$database[$username];
    }
}