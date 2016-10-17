<?php
declare (strict_types = 1);

namespace core;

use model\UserModel;

final class Session {

    private function __construct() {
        // EMPTY: Private construct prevents initialization
    }

    public static function start() {
        session_start();
    }

    /**
     * @param string $key
     * @param $value
     */
    private static function set(string $key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    private static function get(string $key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @return mixed
     */
    private static function getOnce(string $key) {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            Session::delete($key);
            return $value;
        }

        return null;
    }

    /**
     * @param string $key
     */
    private static function delete(string $key) {
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        session_unset();
        session_destroy();
    }

    public static function getId() {
        return session_id();
    }

    /**
     * @return UserModel
     */
    public static function getUser() : UserModel {
        return self::get('user') ?? new UserModel();
    }

    /**
     * @param UserModel $user
     */
    public static function setUser(UserModel $user) {
        self::set('user', $user);
    }

    /**
     * @return string
     */
    public static function getUsername() : string {
        return (string)self::getOnce('username') ?? '';
    }

    /**
     * @param string $username
     */
    public static function setUsername(string $username) {
        self::set('username', $username);
    }

    /**
     * @return string
     */
    public static function getFeedback() : string {
        return self::getOnce('feedback') ?? '';
    }

    /**
     * @param string $feedback
     */
    public static function setFeedback(string $feedback) {
        self::set('feedback', $feedback);
    }

    /**
     * @return bool
     */
    public static function isUserLoggedIn() : bool {
        return (bool)(self::get('UserLoggedIn') ?? false);
    }

    /**
     * @param bool $status
     */
    public static function setUserLoggedInStatus(bool $status) {
        self::set('UserLoggedIn', $status);
    }

    /**
     * @return string
     */
    public static function getAction() : string {
        return strval(self::get('action'));
    }

    /**
     * @param string $action
     */
    public static function setAction(string $action) {
        self::set('action', $action);
    }

    /**
     * @return string
     */
    public static function getErrorMessage() : string {
        return strval(self::get('errorMessage'));
    }

    /**
     * @param string $errorMessage
     */
    public static function setErrorMessage(string $errorMessage) {
        self::set('errorMessage', $errorMessage);
    }

    /**
     * @return bool
     */
    public static function isConcurrentSession() : bool {
        if (Session::isUserLoggedIn()) {
            $newUserIpAddress = $_SERVER['REMOTE_ADDR'];
            $newUserBrowser = $_SERVER['HTTP_USER_AGENT'];
            $newUserSessionId = self::getId();

            $existingUser = Session::getUser();

            if ($newUserSessionId === $existingUser->getSessionId() && ($newUserBrowser !== $existingUser->getBrowser() || $newUserIpAddress !== $existingUser->getIp())) {
                return true;
            }
        }

        return false;
    }
}
