<?php
declare (strict_types = 1);

require_once('./model/RegisterModel.php');

class RegisterController {

    private $view;

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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