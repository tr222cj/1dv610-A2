<?php

/**
 * Class Session
 * Gives easy access to some Session operations
 */
class Session {
    /**
     * Sets a session variable
     * @param string $key The name of the key
     * @param string $value The value
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Sets a session variable once. When you ::get it the first time the variable will be emptied
     * @param string $key The name of the key
     * @param mixed $value The value and can be string, object, array or anything
     */
    public static function setOnce($key, $value) {
        $_SESSION[$key] = $value;
        //TODO: Should probably make this into an array so that you can have more than one set-once keys at the same time
        self::set('set-once', $key);
    }

    /**
     * Gets the value of a session variable
     * @param string $key The name of the key you want to get
     * @return mixed The contents of the session variable with name $key
     */
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];

            if (isset($_SESSION['set-once']) && $_SESSION['set-once'] === $key) {
                self::delete('set-once');
                self::delete($key);
            }

            return $value;
        }

        return null;
    }

    /**
     * Deletes/nullifies/unsets a session variable
     * @param string $key The name of the key you want to delete
     */
    public static function delete($key) {
        self::set('$key', null);
        unset($_SESSION[$key]);
    }

    /**
     * Destroys/unsets current session
     */
    public static function destroy() {
        unset($_SESSION);
        session_destroy();
    }

    /**
     * Start or resume a session
     */
    public static function start() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * @return mixed
     */
    public static function isUserLoggedIn() {
        return self::get('isUserLoggedIn');
    }
}