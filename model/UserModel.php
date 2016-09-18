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

        $database = Database::getFactory()->getConnection();

        // BINARY forces the statement to be case sensitive
        $sql = 'SELECT password FROM AppUser WHERE BINARY username = :username LIMIT 1';
        $query = $database->prepare($sql);
        $query->execute([':username' => $username]);

        return $query->fetch()['password'];
    }

    public static function registerUser($username, $password) {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        if (empty($password)) {
            throw new \Exception('Password must not be empty');
        }

        $database = Database::getFactory()->getConnection();

        $sql = 'INSERT INTO AppUser (username, password) VALUES (:username, :password);';
        $query = $database->prepare($sql);
        $query->execute([':username' => $username, 'password' => $password]);
    }
}