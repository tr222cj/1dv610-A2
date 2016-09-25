<?php
declare (strict_types = 1);

namespace model;

require_once('./model/UserModel.php');

use \Session;

class RegisterModel {

    /**
     * @param string $username
     * @param string $password
     * @param string $passwordRepeated
     * @return bool
     */
    public static function register(string $username, string $password, string $passwordRepeated) : bool {
        // Save the username up here so that we can input it into the form even if validation fails
        Session::set('username-register', $username);

        $feedback = '';
        $success = true;

        if (strlen($username) < 3) {
            $feedback .= 'Username has too few characters, at least 3 characters.<br/>';
            $success = false;
        }

        if (strlen($password) < 6) {
            $feedback .= 'Password has too few characters, at least 6 characters.<br/>';
            $success = false;
        }

        // Do this check BEFORE you send anything to the database
        if ($username !== strip_tags($username)) {
            Session::set('username-register', strip_tags($username));
            $feedback .= 'Username contains invalid characters.<br/>';
            $success = false;
        }

        if (!$success) {
            Session::setOnce('feedback-register', $feedback);
            return false;
        }

        if ($password !== $passwordRepeated) {
            Session::setOnce('feedback-register', 'Passwords do not match.');
            return false;
        }


        if (UserModel::getUserByUserName($username)) {
            Session::setOnce('feedback-register', 'User exists, pick another username.');
            return false;
        }

        UserModel::registerNewUser($username, $password);
        Session::setOnce('feedback', 'Registered new user.');
        Session::set('username', $username);
        return true;
    }
}