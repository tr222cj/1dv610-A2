<?php
declare (strict_types = 1);

namespace model;

use core\DatabaseFactory;
use PDO;

final class UserDALMySql implements UserDAL {

    private function __construct() {
        // EMPTY: Private construct prevents initialization
    }

    public static function select(string $username) : UserModel {
        if (empty($username)) {
            throw new \Exception('Username must not be empty');
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        // BINARY forces the statement to be case sensitive
        $sql = 'SELECT * FROM AppUser WHERE BINARY username = :username LIMIT 1';
        $query = $database->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, '\\model\\UserModel');
        $query->execute([':username' => $username]);

        $user = $query->fetch();

        if (empty($user)) {
            $user = new UserModel();
            $user->setUsername($username);
        }

        return $user;
    }

    public static function save(UserModel $user) {
        if ($user->getId() === 0) {
            self::insert($user);
        } else {
            self::update($user);
        }
    }

    private static function insert(UserModel $user) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'INSERT INTO AppUser (username, password) VALUES (:username, :password);';

        $query = $database->prepare($sql);

        $query->execute([
            ':username' => $user->getUsername(),
            'password' => $user->getPassword(),
        ]);
    }

    private static function update(UserModel $user) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'UPDATE AppUser SET
                username = :username,
                password = :password,
                token = :token,
                sessionId = :session_id,
                ip = :ip,
                browser = :browser
                WHERE id = :id;';

        $query = $database->prepare($sql);

        $query->execute([
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
            ':token' => $user->getToken(),
            ':session_id' => $user->getSessionId(),
            ':ip' => $user->getIp(),
            ':browser' => $user->getBrowser(),
            ':id' => $user->getId(),
        ]);
    }
}
