<?php

class Session
{
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key];
    }

    public static function destroy() {
        unset($_SESSION);
        session_destroy();
    }

    public static function start() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }
}