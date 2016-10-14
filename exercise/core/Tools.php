<?php
declare (strict_types = 1);

namespace core;

use setting\Setting;

final class Tool {

    /**
     * @return bool
     */
    public static function isTestEnvironment() : bool {
        return getenv('APPLICATION_ENV') === 'test';
    }

    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password) : string {
        $hashAlgorithm = Setting::HASH_ALGORITHM;
        $hashOptions = Setting::HASH_OPTIONS;

        return password_hash($password, $hashAlgorithm, $hashOptions);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function verifyPassword(string $password, string $hash) : bool {
        return password_verify($password, $hash);
    }

    /**
     * @return string
     */
    public static function generateToken() : string {
        return bin2hex(random_bytes(128));
    }
}
