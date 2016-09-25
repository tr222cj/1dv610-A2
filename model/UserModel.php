<?php
declare (strict_types = 1);

namespace model;

use \Tools;
use \Exception;
use \DatabaseFactory;

class UserModel {

    /**
     * @param string $username
     * @return mixed
     * @throws Exception
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
     * @throws Exception
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
     * @throws Exception
     */
    public static function saveTokenByUserName(string $username, string $token) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $token = empty($token) ? null : $token;

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'UPDATE AppUser SET token = :token WHERE username = :user_name;';
        $query = $database->prepare($sql);
        $query->execute([':token' => $token, ':user_name' => $username]);
    }

    /**
     * @param string $username
     * @param string $sessionId
     * @throws Exception
     */
    public static function saveSessionIdByUserName(string $username, string $sessionId) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $sessionId = empty($sessionId) ? null : $sessionId;

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'UPDATE AppUser SET sessionId = :session_id WHERE username = :user_name;';
        $query = $database->prepare($sql);
        $query->execute([':session_id' => $sessionId, ':user_name' => $username]);
    }

    public static function saveIpAdressByUserName(string $username, string $ipAdress) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $ipAdress = empty($ipAdress) ? null : $ipAdress;

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'UPDATE AppUser SET ip = :ip_adress WHERE username = :user_name;';
        $query = $database->prepare($sql);
        $query->execute([':ip_adress' => $ipAdress, ':user_name' => $username]);
    }

    public static function saveBrowserInfoByUserName(string $username, string $browser) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $browser = empty($browser) ? null : $browser;

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'UPDATE AppUser SET browser = :browser WHERE username = :user_name;';
        $query = $database->prepare($sql);
        $query->execute([':browser' => $browser, ':user_name' => $username]);
    }
}
