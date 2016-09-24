<?php
declare (strict_types = 1);

class Tools {

    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password) : string {
        $hashAlgo = Config::getConfig('hash-algo');
        if (!$hashAlgo) {
            $hashAlgo = PASSWORD_DEFAULT;
        }

        $hashOptions = Config::getConfig('hash-options');
        if (!$hashOptions) {
            $hashOptions = [
                'cost' => 10,
            ];
        }

        return password_hash($password, $hashAlgo, $hashOptions);
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