<?php
declare (strict_types = 1);

namespace controller;

require_once('./model/LoginModel.php');

use core\Controller;
use core\Cookie;
use core\Session;
use model\LoginModel;

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        Session::set('action', 'login');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            Cookie::tryLoginByCookies();

            $data = [
                'message' => Session::get('feedback'),
                'username' => Session::get('username'),
            ];

            if (Session::get('isUserLoggedIn')) {
                $this->view->render('/login/logout', $data);
            } else {
                $this->view->render('/login/index', $data);
            }
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
