<?php

/**
 * Class Database
 */
class Database {

    private static $databaseFile = './data/database.txt';

    public static function getDatabase() {
        try {
            if (!file_exists(self::$databaseFile)) {
                $database = [
                    'Admin' => 'Password',
                ];

                self::saveDatabase($database);

            }

            $recoveredData = file_get_contents(self::$databaseFile);

            return unserialize($recoveredData);
        } catch (\Exception $e) {
            throw new \Exception("Could not load database :(");
        }
    }

    public static function saveDatabase($database) {
        try {
            $serializedData = serialize($database);

            file_put_contents(self::$databaseFile, $serializedData);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}