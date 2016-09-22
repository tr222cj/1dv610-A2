<?php

require_once('./model/UserModel.php');

/**
 * Class LoginModel
 */
class LoginModel {

    /**
     * Tries to perform a login
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public static function login($username, $password, $remember) {
        // Save the username up here so that we can input it into the form even if validation fails
        Session::set('username', $username);

        if (Session::get('isUserLoggedIn')) {
            return true;
        }

        if (empty($username)) {
            Session::set('feedback', 'Username is missing');
            return false;
        }

        if (empty($password)) {
            Session::set('feedback', 'Password is missing');
            return false;
        }

        if (self::validateUser($username, $password)) {
            if ($remember) {
                self::generateAndSaveCookieToken($username);
                Session::setOnce('feedback', 'Welcome and you will be remembered');
            } else {
                // Should I empty the token for the user in the database if the user chooses not to rememberme?
                Session::setOnce('feedback', 'Welcome');
            }

            Session::set('isUserLoggedIn', true);
            return true;
        }

        return false;
    }

    /**
     * Logout current user
     */
    public static function logout() {
        Session::destroy();
        Session::start();
        Session::setOnce('feedback', 'Bye bye!');
        unset($_COOKIE['rememberme']);
        setcookie('rememberme', '', time() - 3600, '/');
    }

    /**
     * Validates user credentials
     * @param string $username
     * @param string $password
     * @return bool
     */
    private static function validateUser($username, $password) {
        $user = UserModel::getUserByUserName($username);

        if (!$user || !Tools::verifyPassword($password, $user['password'])) {
            Session::set('feedback', 'Wrong name or password');
            return false;
        }

        Session::set('user', $user);
        return true;
    }

    /**
     * Generates and saves a cookie token for current user that has chosen to be remembered
     * This is a somewhat modified version of ircmaxell's response here:
     * http://stackoverflow.com/questions/1354999/keep-me-logged-in-the-best-approach
     *
     * @param string $username
     */
    private static function generateAndSaveCookieToken($username) {
        $token = bin2hex(random_bytes(128));
        UserModel::saveTokenBySession($token);

        $cookie = $username . ':' . $token;
        $mac = hash_hmac('sha256', $cookie, Config::getConfig('secret'));
        $cookie .= ':' . $mac;
        setcookie('rememberme', $cookie);
    }

    public static function validateCookieToken($cookieToken) {
        list ($username, $token, $mac) = explode(':', $cookieToken);
        if (hash_equals(hash_hmac('sha256', $username . ':' . $token, Config::getConfig('secret')), $mac)) {
            $user = UserModel::getUserByUserName($username);
            if (hash_equals($user['token'], $token)) {
                Session::setOnce('feedback', 'Welcome back with cookie');
                Session::set('username', $username);
                Session::set('isUserLoggedIn', true);
            }
        }
    }
}