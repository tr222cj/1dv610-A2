<?php
declare (strict_types = 1);

namespace model;

require_once('./model/UserModel.php');
require_once('./model/UserDALMySql.php');

use core\Cookie;
use core\Session;
use core\Tool;

class LoginModel {

    /**
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public function login(string $username, string $password, bool $remember) : bool {
        if (Session::isUserLoggedIn()) {
            return true;
        }

        // Save the username up here so that we can input it into the form even if validation fails
        Session::setUsername($username);

        if (empty($username)) {
            Session::setFeedback('Username is missing');
            return false;
        }

        if (empty($password)) {
            Session::setFeedback('Password is missing');
            return false;
        }

        if ($this->isValidUserCredentials($username, $password)) {
            Session::setUserLoggedInStatus(true);
            Session::setFeedback('Welcome');

            $user = Session::getUser();
            $user->setSessionId(Session::getId());
            $user->setIp($_SERVER['REMOTE_ADDR']);
            $user->setBrowser($_SERVER['HTTP_USER_AGENT']);

            if ($remember) {
                $token = Tool::generateToken();

                $user->setToken($token);

                Cookie::setRememberMeCookies($username, $token);

                Session::setFeedback('Welcome and you will be remembered');
            }

            UserDALMySql::save($user);

            return true;
        } else {
            Session::setFeedback('Wrong name or password');
        }

        return false;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    private function isValidUserCredentials(string $username, string $password) : bool {
        $user = UserDALMySql::select($username);

        if (Tool::verifyPassword($password, $user->getPassword())) {
            Session::setUser($user);

            return true;
        }

        return false;
    }

    public function logout() {
        if (!Session::isUserLoggedIn()) {
            return;
        }

        Cookie::deleteRememberMeCookies();

        $user = Session::getUser();
        $user->setToken('');
        $user->setSessionId('');
        $user->setIp('');
        $user->setBrowser('');

        UserDALMySql::save($user);

        Session::destroy();

        Session::start();
        Session::setFeedback('Bye bye!');
    }
}
