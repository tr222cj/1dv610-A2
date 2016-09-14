<?php

require_once('./model/LoginModel.php');

class LoginController {

    /**
     * Renders the current view
     */
    public function render() {
        $username = $_POST['LoginView::UserName'];
        $password = $_POST['LoginView::Password'];

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && LoginModel::login($username, $password)) {
            // require_once('./view/LogoutView.php');
        } else {
            $message = Session::get('feedback');
            require_once('./view/LoginView.php');
        }
    }
}