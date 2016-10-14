<?php
declare (strict_types = 1);

namespace controller;

require_once('./model/LoginModel.php');
require_once('./view/LoginView.php');
require_once('./core/Cookie.php');

use core\Cookie;
use core\Session;
use model\LoginModel;
use view\LoginBaseView;

class LoginController extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->view = new LoginBaseView();
        $this->model = new LoginModel();
    }

    public function init() {
        Session::setAction('login');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            Cookie::tryLoginByCookies();

            $data = [
                'message' => Session::getFeedback(),
                'username' => Session::getUsername(),
            ];

            if (Session::isUserLoggedIn()) {
                $this->view->render('/login/logout', $data);
            } else {
                $this->view->render('/login/index', $data);
            }
        }

        if ($this->view->isActionLogin()) {
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            $remember = $this->view->isRememberMeSet();

            $this->model->login($username, $password, $remember);

            header('Location: ' . '/');
            exit();
        }

        if ($this->view->isActionLogout()) {
            $this->model->logout();

            header('Location: ' . '/');
            exit();
        }
    }
}
