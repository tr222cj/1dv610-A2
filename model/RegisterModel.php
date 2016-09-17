<?php

require_once('./model/UserModel.php');

/**
 * Class RegisterModel
 */
class RegisterModel {

    public static function register($username, $password, $passwordRepeat) {
        Session::set('username-register', $username);

        $feedback = '';
        $success = true;

        if (strlen($username) < 3) {
            $feedback .= 'Username has too few characters, at least 3 characters.<br>';
            $success = false;
        }

        if (strlen($password) < 6) {
            $feedback .= 'Password has too few characters, at least 6 characters.<br>';
            $success = false;
        }

        if (!$success) {
            Session::set('feedback-register', $feedback);
            return false;
        }

        if ($password !== $passwordRepeat) {
            Session::set('feedback-register', 'Passwords do not match.');
            return false;
        }

        return true;
    }
}