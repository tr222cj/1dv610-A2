<?php
declare (strict_types = 1);

require_once('./model/UserModel.php');

class RegisterModel {

    /**
     * @param string $username
     * @param string $password
     * @param string $passwordRepeat
     * @return bool
     */
    public static function register(string $username, string $password, string $passwordRepeat) : bool {
        // Save the username up here so that we can input it into the form even if validation fails
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

        // Do this check BEFORE you send anything to the database
        if ($username !== strip_tags($username)) {
            Session::set('username-register', strip_tags($username));
            $feedback .= 'Username contains invalid characters.<br>';
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


        if (UserModel::getUserByUserName($username)) {
            Session::set('feedback-register', 'User exists, pick another username.');
            return false;
        }

        UserModel::registerNewUser($username, $password);
        Session::set('feedback', 'Registered new user.');
        Session::set('username', $username);
        return true;
    }
}