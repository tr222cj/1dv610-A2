<?php
declare (strict_types = 1);

namespace controller;

require_once('./model/RegisterModel.php');

use core\Session;
use model\RegisterModel;

class RegisterController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        Session::set('action', 'register');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (Session::isUserLoggedIn()) {
                header('Location: ' . '/');
                exit();
            }

            $data = [
                'message' => Session::get('feedback-register'),
                'username' => Session::get('username-register'),
            ];

            $this->view->render('/register/index', $data);
        }

        if ($this->view->isRegisterAction()) {
            $username = $this->view->getRegisterName();
            $password = $this->view->getRegisterPassword();
            $passwordRepeat = $this->view->getRegisterPasswordRepeat();

            if (RegisterModel::register($username, $password, $passwordRepeat)) {
                header('Location: ' . '/');
                exit();
            } else {
                header('Location: ' . '/?register');
                exit();
            }
        }
    }
}
