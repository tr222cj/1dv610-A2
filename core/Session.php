<?php

/**
 * Class Session
 * Gives easy access to some Session operations
 */
class Session
{
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
        self::set('feedback-once', true);
    }

    /**
     * Gets the value of a session variable
     * @param string $key The name of the key you want to get
     * @return mixed The contents of the session variable with name $key
     */
    public static function get($key) {
        $value = $_SESSION[$key];

        if ($_SESSION['feedback-once']) {
            self::delete('feedback-once');
            self::delete($key);
        }

        return $value;
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
}