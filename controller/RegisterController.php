<?php

require_once('./model/RegisterModel.php');

/**
 * Class RegisterController
 */
class RegisterController
{
    /** @var View view */
    private $view;

    /**
     * RegisterController constructor
     * Creates a new controller and renders its views
     */
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view = new View();

            $data = [
                "message" => Session::get('feedback-register'),
                "username" => Session::get('username-register'),
            ];

            $this->view->render('RegisterView', $data);
        }

        if (isset($_POST['RegisterView::Register'])) {
            $username = $_POST['RegisterView::UserName'];
            $password = $_POST['RegisterView::Password'];
            $passwordRepeat = $_POST['RegisterView::PasswordRepeat'];
            RegisterModel::register($username, $password, $passwordRepeat);

            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
    }
}