<?php
declare (strict_types = 1);

namespace controller;

require_once('./model/LoginModel.php');
require_once('./core/Cookie.php');
require_once('./view/LoginView.php');

use core\Cookie;
use core\Session;
use model\LoginModel;
use view\LoginBaseView;

class LoginController extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->view = new LoginBaseView();
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

        if ($this->view->isLoginAction()) {
            $username = $this->view->getLoginName();
            $password = $this->view->getLoginPassword();
            $remember = $this->view->isLoginRememberMeSet();
            LoginModel::login($username, $password, $remember);

            header('Location: ' . '/');
            exit();
        }

        if ($this->view->isLogoutAction()) {
            LoginModel::logout();

            header('Location: ' . '/');
            exit();
        }
    }
}
