<?php
declare (strict_types = 1);

namespace model;

use core\Session;

final class RegisterModel {

    private static $minNumberOfCharsInUsername = 3;
    private static $minNumberOfCharsInPassword = 6;

    /**
     * @param string $username
     * @param string $password
     * @param string $passwordRepeated
     * @return bool
     */
    public static function register(string $username, string $password, string $passwordRepeated) : bool {
        // Save the username up here so that we can input it into the form even if validation fails
        Session::setUsername($username);

        $feedback = '';
        $fail = false;

        if (strlen($username) >= self::$minNumberOfCharsInUsername && UserDALMySql::select($username)->getId() !== 0) {
            Session::setFeedback('User exists, pick another username.');
            return false;
        }

        if (strlen($username) < self::$minNumberOfCharsInUsername) {
            $feedback .= 'Username has too few characters, at least 3 characters.<br/>';
            $fail = true;
        }

        if (strlen($password) < self::$minNumberOfCharsInPassword) {
            $feedback .= 'Password has too few characters, at least 6 characters.<br/>';
            $fail = true;
        }

        if ($username !== strip_tags($username)) {
            Session::setUsername(strip_tags($username));
            $feedback .= 'Username contains invalid characters.<br/>';
            $fail = true;
        }

        if ($fail) {
            Session::setFeedback($feedback);
            return false;
        }

        if ($password !== $passwordRepeated) {
            Session::setFeedback('Passwords do not match.');
            return false;
        }

        $user = new UserModel();
        $user->setUsername($username);
        $user->setAndHashPassword($password);

        UserDALMySql::save($user);

        Session::setFeedback('Registered new user.');

        return true;
    }
}
