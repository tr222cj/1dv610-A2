<?php
declare (strict_types = 1);

namespace core;

final class Session {

    public static function destroy() {
        session_regenerate_id(false);
        unset($_SESSION);
        session_destroy();
    }

    public static function start() {
        if (!isset($_SESSION)) {
            session_start();
        }
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
     */
    public static function delete(string $key) {
        self::set('$key', null);
        unset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value) {
        // XSS Filter but not for feedbacks since they will never contain user input
        if (is_string($value) && strpos($key, 'feedback') === false) {
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        $_SESSION[$key] = $value;
    }

    /**
     * @return bool
     */
    public static function isUserLoggedIn() : bool {
        $isUserLoggedIn = self::get('isUserLoggedIn');
        return isset($isUserLoggedIn) ? $isUserLoggedIn : false;
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
     * @return bool
     */
    public static function isConcurrentSession() : bool {
        $newUserIpAddress = $_SERVER['REMOTE_ADDR'];
        $newUserBrowser = $_SERVER['HTTP_USER_AGENT'];
        $newUserSessionId = session_id();

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT sessionId, browser, ip FROM AppUser WHERE sessionId = :session_id LIMIT 1";

        $query = $database->prepare($sql);
        $query->execute(array(":session_id" => $newUserSessionId));

        $existingUser = $query->fetch();

        if ($newUserSessionId === $existingUser['sessionId'] && ($newUserBrowser !== $existingUser['browser'] || $newUserIpAddress !== $existingUser['ip'])) {
            return true;
        }

        return false;
    }
}
