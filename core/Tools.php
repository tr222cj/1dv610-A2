<?php

/**
 * Class Tools
 * A collection of useful tools
 */
class Tools {

    /**
     * Hash and salt a password
     * @param string $password
     * @return string Hashed and salted password
     */
    public static function hashPassword($password) {
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
     * Verify supplied password against hash
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * @return string Token
     */
    public static function generateCookieToken() {
        return bin2hex(random_bytes(128));
    }

    /**
     * @return string Token
     */
    public static function generateCsrfToken() {
        $token = bin2hex(random_bytes(64));
        Session::set('csrfToken', $token);

        return $token;
    }

    /**
     * @param string $token
     * @return bool isValidToken
     */
    public static function validateCsrfToken($token) {
        return $token === Session::get('csrfToken');
    }
}
