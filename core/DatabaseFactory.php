<?php
declare (strict_types = 1);

/**
 * Class Database
 *
 * This is a somewhat modified version of the answer here:
 * http://stackoverflow.com/questions/130878/global-or-singleton-for-database-connection
 *
 * Usage: $database = DatabaseFactory::getFactory()->getConnection();
 */
class DatabaseFactory {

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
     * @return PDO
     */
    public function getConnection() : PDO {
        $host = Config::getConfig('host');
        $db = Config::getConfig('db');
        $user = Config::getConfig('user');
        $pass = Config::getConfig('pass');
        $charset = Config::getConfig('charset');

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // http://php.net/manual/en/ref.pdo-mysql.php
        $opt = [
            PDO::ATTR_ERRMODE => Config::getConfig('exceptions'),
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        if (!$this->database) {
            $this->database = new PDO($dsn, $user, $pass, $opt);
        }

        return $this->database;
    }
}