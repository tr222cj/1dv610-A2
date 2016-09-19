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
     * @return bool
     */
    public static function login($username, $password) {
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

        return self::validateUser($username, $password);
    }

    /**
     * Logout current user
     */
    public static function logout() {
        Session::destroy();
        Session::start();
        Session::setOnce('feedback', 'Bye bye!');
    }

    /**
     * Validates user credentials
     * @param string $username
     * @param string $password
     * @return bool
     */
    private static function validateUser($username, $password) {
        $user = UserModel::getUser($username);

        if (!$user || !Tools::verifyPassword($password, $user)) {
            Session::set('feedback', 'Wrong name or password');
            return false;
        }

        Session::set('user', $user);
        Session::set('isUserLoggedIn', true);
        Session::setOnce('feedback', 'Welcome');
        return true;
    }
}