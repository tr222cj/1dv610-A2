<?php
declare (strict_types = 1);

namespace model;

use core\DatabaseFactory;
use core\Tools;

class UserModel {

    /**
     * @param string $username
     * @return mixed
     * @throws \Exception
     */
    public static function getUserByUserName(string $username) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        // BINARY forces the statement to be case sensitive
        $sql = 'SELECT * FROM AppUser WHERE BINARY username = :username LIMIT 1';
        $query = $database->prepare($sql);
        $query->execute([':username' => $username]);

        return $query->fetch();
    }

    /**
     * @param string $username
     * @param string $password
     * @throws \Exception
     */
    public static function registerNewUser(string $username, string $password) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        if (empty($password)) {
            throw new \Exception('Password must not be empty');
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'INSERT INTO AppUser (username, password) VALUES (:username, :password);';
        $query = $database->prepare($sql);
        $query->execute([':username' => $username, 'password' => Tools::hashPassword($password)]);
    }

    /**
     * @param string $username
     * @param string $token
     */
    public static function saveTokenByUserName(string $username, string $token) {
        self::saveDataToDatabase($username, $token, "token");
    }

    /**
     * @param string $username
     * @param string $sessionId
     */
    public static function saveSessionIdByUserName(string $username, string $sessionId) {
        self::saveDataToDatabase($username, $sessionId, "sessionId");
    }

    /**
     * @param string $username
     * @param string $ipAddress
     */
    public static function saveIpAdressByUserName(string $username, string $ipAddress) {
        self::saveDataToDatabase($username, $ipAddress, "ip");
    }

    /**
     * @param string $username
     * @param string $browser
     */
    public static function saveBrowserInfoByUserName(string $username, string $browser) {
        self::saveDataToDatabase($username, $browser, "browser");
    }

    /**
     * @param string $username
     * @param string $data
     * @param string $columnName
     * @throws \Exception
     */
    private static function saveDataToDatabase(string $username, string $data, string $columnName) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $validColumnNames = ['sessionId', 'token', 'ip', 'browser'];

        if (in_array($columnName, $validColumnNames)) {
            $data = empty($data) ? null : $data;

            $database = DatabaseFactory::getFactory()->getConnection();

            $sql = 'UPDATE AppUser SET ' . $columnName . ' = :data WHERE username = :user_name;';
            $query = $database->prepare($sql);
            $query->execute([':data' => $data, ':user_name' => $username]);
        } else {
            throw new \Exception('Invalid columnName');
        }
    }
}
