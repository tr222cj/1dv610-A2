<?php
declare (strict_types = 1);

class Session {

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function setOnce(string $key, $value) {
        $_SESSION[$key] = $value;
        //TODO: Should probably make this into an array so that you can have more than one set-once keys at the same time
        self::set('set-once', $key);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key) {
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
     * @param string $key
     */
    public static function delete(string $key) {
        self::set('$key', null);
        unset($_SESSION[$key]);
    }

    /**
     *
     */
    public static function destroy() {
        unset($_SESSION);
        session_destroy();
    }

    /**
     *
     */
    public static function start() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * @return bool
     */
    public static function isUserLoggedIn() : bool {
        $isUserLoggedIn = self::get('isUserLoggedIn');
        return isset($isUserLoggedIn) ? $isUserLoggedIn : false;
    }
}