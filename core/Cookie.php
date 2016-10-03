<?php
declare (strict_types = 1);

namespace core;

final class Cookie {

    /**
     * @return bool
     */
    public static function isCookiesSet() : bool {
        $cookieName = self::get('LoginView::CookieName');
        $cookiePassword = self::get('LoginView::CookiePassword');

        if (isset($cookieName) && isset($cookiePassword)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public static function set(string $key, string $value) {
        setcookie($key, $value, time() + 3600 * 24 * 7);
    }

    /**
     * @param string $key
     */
    public static function delete(string $key) {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600, '/', $_SERVER['SERVER_NAME'], false, true);
        }
    }
}
