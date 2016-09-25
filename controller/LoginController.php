<?php

namespace controller;

require_once('./model/LoginModel.php');

use \View;
use \Session;
use \Cookie;
use \model\LoginModel;

class LoginController {

    /** @var View view */
    private $view;

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view = new View();

            if (!Session::isUserLoggedIn() && Cookie::isCookiesSet()) {
                LoginModel::validateCookieLogin(Cookie::get('LoginView::CookieName'), Cookie::get('LoginView::CookiePassword'));
            }

            $data = [
                'message' => Session::get('feedback'),
                'username' => Session::get('username'),
            ];

            if (Session::get('isUserLoggedIn')) {
                $this->view->render('LogoutView', $data);
            }

            $this->view->render('LoginView', $data);
        }

        if (isset($_POST['LoginView::Logout'])) {
            if (Session::get('isUserLoggedIn')) {
                LoginModel::logout();
            }

            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }

        if (isset($_POST['LoginView::Login'])) {
            $username = $_POST['LoginView::UserName'];
            $password = $_POST['LoginView::Password'];
            $remember = isset($_POST['LoginView::KeepMeLoggedIn']);
            LoginModel::login($username, $password, $remember);

            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    }
}