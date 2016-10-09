<?php
declare (strict_types = 1);

namespace core;

use setting\Setting;

/**
 * Class Database
 *
 * This is a somewhat modified version of the answer here:
 * http://stackoverflow.com/questions/130878/global-or-singleton-for-database-connection
 *
 * Usage: $database = DatabaseFactory::getFactory()->getConnection();
 */
final class DatabaseFactory {

    private static $factory;
    private $database;

    /**
     * @return DatabaseFactory
     */
    public static function getFactory() : DatabaseFactory {
        if (!self::$factory) {
            self::$factory = new DatabaseFactory();
        }

        return self::$factory;
    }

    /**
     * @return \PDO
     */
    public function getConnection() : \PDO {
        $host = Setting::DB_HOST;
        $db = Setting::DB_NAME;
        $user = Setting::DB_USER;
        $pass = Setting::DB_PASSWORD;
        $charset = Setting::DB_CHARSET;

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // http://php.net/manual/en/ref.pdo-mysql.php
        $opt = [
            \PDO::ATTR_ERRMODE => Setting::DB_ERROR_MODE,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        if (!$this->database) {
            $this->database = new \PDO($dsn, $user, $pass, $opt);
        }

        return $this->database;
    }
}
