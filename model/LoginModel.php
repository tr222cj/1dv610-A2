<?php

require_once('./model/UserModel.php');

class LoginModel
{
    public static function login($username, $password) {
        Session::set('feedback', '');

        if (isset($_POST['LoginView::Logout'])) {
            Session::destroy();
            $_POST = [];
        }

        if (!isset($_POST['LoginView::Login'])) {
            return false;
        }

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

    private static function validateUser($username, $password) {
        $user = UserModel::getUser($username);

        if (!$user || $user !== $password) {
            Session::set('feedback', 'Wrong name or password');
            return false;
        }

        Session::set('user', $user);
        Session::set('isUserLoggedIn', true);
        Session::set('feedback', 'Welcome');
        return true;
    }
}