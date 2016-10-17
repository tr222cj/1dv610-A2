<?php
declare (strict_types = 1);

namespace controller;

use core\Session;
use model\RegisterModel;
use view\RegisterView;

final class RegisterController extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->view = new RegisterView();
    }

    public function init() {
        Session::setAction('register');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (Session::isUserLoggedIn()) {
                header('Location: ' . '/');
                exit();
            }

            $data = [
                'message' => Session::getFeedback(),
                'username' => Session::getUsername(),
            ];

            $this->view->render('/register/index', $data);
        }

        if ($this->view->isActionRegister()) {
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            $passwordRepeat = $this->view->getPasswordRepeat();

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
