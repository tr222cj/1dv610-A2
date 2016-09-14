<?php

class Session
{
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        $value = $_SESSION[$key];
        $_SESSION[$key] = '';
        return $value;
    }
}