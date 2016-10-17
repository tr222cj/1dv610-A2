<?php
declare (strict_types = 1);

namespace core;

use model\UserDALMySql;

final class Cookie {

    private static $usernameCookieName = 'LoginView::CookieName';
    private static $passwordCookieName = 'LoginView::CookiePassword';

    private function __construct() {
        // EMPTY: Private construct prevents initialization
    }

    /**
     * Tries to perform a login based on the data in cookies.
     */
    public static function tryLoginByCookies() {
        if (Session::isUserLoggedIn() || !self::isCookiesSet()) {
            return;
        }

        $username = self::get(self::$usernameCookieName);
        $token = self::get(self::$passwordCookieName);
        $user = UserDALMySql::select($username);

        if ($user && $user->getToken() === $token) {
            Session::setFeedback('Welcome back with cookie');
            Session::setUserLoggedInStatus(true);
            Session::setUser($user);
        } else {
            self::deleteRememberMeCookies();
            Session::setFeedback('Wrong information in cookies');
        }
    }

    /**
     * @return bool
     */
    private static function isCookiesSet() : bool {
        $cookieUsername = self::get(self::$usernameCookieName);
        $cookiePassword = self::get(self::$passwordCookieName);

        if (empty($cookieUsername) || empty($cookiePassword)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $key
     * @return string
     */
    private static function get(string $key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }

        return '';
    }

    /**
     * @param string $key
     * @param string $value
     */
    private static function set(string $key, string $value) {
        setcookie($key, $value, time() + 3600 * 24 * 7, '/', $_SERVER['SERVER_NAME'], false, true);
    }

    /**
     * @param string $key
     */
    private static function delete(string $key) {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600, '/', $_SERVER['SERVER_NAME'], false, true);
        }
    }

    /**
     * @param string $username
     * @param string $token
     */
    public static function setRememberMeCookies(string $username, string $token) {
        self::set(self::$usernameCookieName, $username);
        self::set(self::$passwordCookieName, $token);
    }

    /**
     *
     */
    public static function deleteRememberMeCookies() {
        self::delete(self::$usernameCookieName);
        self::delete(self::$passwordCookieName);
    }
}
