<?php
declare (strict_types = 1);

namespace core;

use model\UserModel;

final class Cookie {

    public static function tryLoginByCookies() {
        if (Session::isUserLoggedIn() || !self::isCookiesSet()) {
            return;
        }

        $username = self::get('LoginView::CookieName');
        $token = self::get('LoginView::CookiePassword');

        $user = UserModel::getUserByUserName($username);

        if ($user && $user['token'] === $token) {
            Session::setOnce('feedback', 'Welcome back with cookie');
            Session::set('isUserLoggedIn', true);
            Session::set('username', $user['username']);
        } else {
            Session::setOnce('feedback', 'Wrong information in cookies');
            self::delete('LoginView::CookieName');
            self::delete('LoginView::CookiePassword');
        }
    }

    /**
     * @return bool
     */
    private static function isCookiesSet() : bool {
        $cookieName = self::get('LoginView::CookieName');
        $cookiePassword = self::get('LoginView::CookiePassword');

        if (empty($cookieName) || empty($cookiePassword)) {
            return false;
        }

        return true;
    }


    /**
     * @param string $key
     * @return string
     */
    public static function get(string $key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }

        return '';
    }

    /**
     * @param string $key
     * @param string $value
     */
    public static function set(string $key, string $value) {
        setcookie($key, $value, time() + 3600 * 24 * 7, '/', $_SERVER['SERVER_NAME'], false, true);
    }

    /**
     * @param string $key
     */
    public static function delete(string $key) {
        if (isset($_COOKIE[$key])) {
            $_COOKIE[$key] = '';
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600, '/', $_SERVER['SERVER_NAME'], false, true);
        }
    }
}
