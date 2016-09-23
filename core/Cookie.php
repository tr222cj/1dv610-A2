<?php

/**
 * Class Cookie
 */
class Cookie {

    /**
     * @return bool
     */
    public static function isCookiesSet() {
        $cookieName = self::get('LoginView::CookieName');
        $cookiePassword = self::get('LoginView::CookiePassword');

        if (isset($cookieName) && isset($cookiePassword)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $key
     * @return mixed Contents of cookie or null
     */
    public static function get($key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public static function set($key, $value) {
        setcookie($key, $value, time() + 3600 * 24 * 7);
    }

    /**
     * @param string $key
     */
    public static function delete($key) {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, null, time() - 3600);
        }
    }
}