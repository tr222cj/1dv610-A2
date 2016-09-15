<?php

require_once('./model/LoginModel.php');

class LoginController {

    /**
     * Renders the current view
     */
    public function render() {
        $username = $_POST['LoginView::UserName'];
        $password = $_POST['LoginView::Password'];

        if (LoginModel::login($username, $password)) {
            $view = 'LogoutView.php';
            require_once('./view/LayoutView.php');
        } else {
            $view = 'LoginView.php';
            require_once('./view/LayoutView.php');
        }
    }
}