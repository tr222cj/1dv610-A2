<?php
declare (strict_types = 1);

namespace model;

require_once('./model/UserModel.php');

use \Session;
use \Tools;
use \Cookie;

class LoginModel {

    /**
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public static function login(string $username, string $password, bool $remember) : bool {
        // Save the username up here so that we can input it into the form even if validation fails
        Session::set('username', $username);

        if (Session::isUserLoggedIn()) {
            return true;
        }

        if (empty($username)) {
            Session::set('feedback', 'Username is missing');
            return false;
        }

        if (empty($password)) {
            Session::set('feedback', 'Password is missing');
            return false;
        }

        if (self::validateUserCredentials($username, $password)) {
            if ($remember) {
                self::createTokenAndCookies($username);
                Session::setOnce('feedback', 'Welcome and you will be remembered');
            }

            return true;
        }

        return false;
    }

    /**
     * @param string $message The message to be displayed instead of default 'Bye bye!'
     */
    public static function logout(string $message = '') {
        // Clear stored session data in database on logout
        if (Session::get('user')) {
            UserModel::saveTokenByUserName(Session::get('user')['username'], '');
            UserModel::saveSessionIdByUserName(Session::get('user')['username'], '');
            UserModel::saveIpAdressByUserName(Session::get('user')['username'], '');
            UserModel::saveBrowserInfoByUserName(Session::get('user')['username'], '');
        }

        Session::destroy();
        Session::start();
        Session::setOnce('feedback', (empty($message) ? 'Bye bye!' : $message));

        Cookie::delete('LoginView::CookieName');
        Cookie::delete('LoginView::CookiePassword');
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    private static function validateUserCredentials(string $username, string $password) : bool {
        $user = UserModel::getUserByUserName($username);

        if (!$user || !Tools::verifyPassword($password, $user['password'])) {
            Session::set('feedback', 'Wrong name or password');
            return false;
        }

        Session::set('user', $user);
        Session::set('isUserLoggedIn', true);
        Session::setOnce('feedback', 'Welcome');
        UserModel::saveSessionIdByUserName($username, session_id());
        UserModel::saveIpAdressByUserName($username, $_SERVER['REMOTE_ADDR']);
        UserModel::saveBrowserInfoByUserName($username, $_SERVER['HTTP_USER_AGENT']);

        return true;
    }

    /**
     * Creates a token and necessary cookies for successful login via cookies
     * @param string $username
     */
    private static function createTokenAndCookies(string $username) {
        $token = Tools::generateToken();
        UserModel::saveTokenByUserName($username, $token);

        Cookie::set('LoginView::CookieName', $username);
        Cookie::set('LoginView::CookiePassword', $token);
    }

    /**
     * Validates cookies against stored information in the database
     * @param string $username
     * @param string $token
     * @return bool
     */
    public static function validateCookieLogin(string $username, string $token) : bool {
        $user = UserModel::getUserByUserName($username);
        Session::set('user', $user);

        if ($user && $user['token'] === $token) {
            Session::setOnce('feedback', 'Welcome back with cookie');
            Session::set('isUserLoggedIn', true);
            return true;
        }

        self::logout('Wrong information in cookies');
        return false;
    }

    /**
     * @return bool
     */
    public static function checkIfConcurrentSessionExists() : bool {
        $newUserIpAddress = $_SERVER['REMOTE_ADDR'];
        $newUserBrowser = $_SERVER['HTTP_USER_AGENT'];
        $newUserSessionId = session_id();

        $existingUser = UserModel::getUserByUserName(Session::get('user')['username']);

        if ($newUserSessionId === $existingUser['sessionId'] && ($newUserBrowser !== $existingUser['browser'] || $newUserIpAddress !== $existingUser['ip'])) {
            session_regenerate_id(false);
            Session::destroy();
            return true;
        }

        return false;
    }
}