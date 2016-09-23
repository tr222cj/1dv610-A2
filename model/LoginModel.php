<?php

require_once('./model/UserModel.php');

/**
 * Class LoginModel
 */
class LoginModel {

    /**
     * Tries to perform a login
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public static function login($username, $password, $remember) {
        // Save the username up here so that we can input it into the form even if validation fails
        Session::set('username', $username);

        if (Session::get('isUserLoggedIn')) {
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

        if (self::validateUser($username, $password)) {
            if ($remember) {
                self::createTokenAndCookies($username);
                Session::setOnce('feedback', 'Welcome and you will be remembered');
            } else {
                Session::setOnce('feedback', 'Welcome');
            }

            Session::set('isUserLoggedIn', true);
            return true;
        }

        return false;
    }

    /**
     * Logout current user
     * @param string $message
     */
    public static function logout($message = '') {
        if (Session::get('user')) {
            UserModel::saveTokenByUserName(Session::get('user')['username'], null);
        }

        Session::destroy();
        Session::start();
        Session::setOnce('feedback', (empty($message) ? 'Bye bye!' : $message));

        Cookie::delete('LoginView::CookieName');
        Cookie::delete('LoginView::CookiePassword');
    }

    /**
     * Validates user credentials
     * @param string $username
     * @param string $password
     * @return bool
     */
    private static function validateUser($username, $password) {
        $user = UserModel::getUserByUserName($username);

        if (!$user || !Tools::verifyPassword($password, $user['password'])) {
            Session::set('feedback', 'Wrong name or password');
            return false;
        }

        Session::set('user', $user);
        Session::set('isUserLoggedIn', true);
        Session::setOnce('feedback', 'Welcome');
        return true;
    }

    /**
     * @param $username
     */
    private static function createTokenAndCookies($username) {
        $token = Tools::generateToken();
        UserModel::saveTokenByUserName($username, $token);

        Cookie::set('LoginView::CookieName', $username);
        Cookie::set('LoginView::CookiePassword', $token);
    }

    /**
     * @param string $username
     * @param string $token
     * @return bool
     */
    public static function validateCookieLogin($username, $token) {
        $user = UserModel::getUserByUserName($username);
        Session::set('user', $user);

        if ($user && $user['token'] === $token) {
            Session::setOnce('feedback', 'Welcome back with cookie');
            Session::set('isUserLoggedIn', true);
        } else {
            self::logout('Wrong information in cookies');
        }
    }
}