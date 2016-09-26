<?php
declare (strict_types = 1);

namespace controller;

require_once('./model/RegisterModel.php');

use \View;
use \Session;
use \model\RegisterModel;

class RegisterController {

    /** @var View view */
    private $view;

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (Session::isUserLoggedIn()) {
                header('Location: ' . '/?');
                exit();
            }

            $this->view = new View();

            $data = [
                'message' => Session::get('feedback-register'),
                'username' => Session::get('username-register'),
            ];

            $this->view->render('RegisterView', $data);
        }

        if (isset($_POST['RegisterView::Register'])) {
            $username = $_POST['RegisterView::UserName'];
            $password = $_POST['RegisterView::Password'];
            $passwordRepeat = $_POST['RegisterView::PasswordRepeat'];

            if (RegisterModel::register($username, $password, $passwordRepeat)) {
                header('Location: ' . '/?');
                exit();
            } else {
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
    }
}