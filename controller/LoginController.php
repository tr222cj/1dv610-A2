<?php

require_once('./model/LoginModel.php');

class LoginController {

    /**
     * Renders the current view
     */
    public function render() {
        $username = $_POST['LoginView::UserName'];
        $password = $_POST['LoginView::Password'];
        $loginSuccess = false;
        $message = '';

        if (isset($_POST['LoginView::Logout'])) {
            (Session::get('isUserLoggedIn')) ? $message = 'Bye bye!' : '';
            Session::destroy();
            $_POST = [];
        }

        if (isset($_POST['LoginView::Login'])) {
            $loginSuccess = LoginModel::login($username, $password);
            $message = Session::get('feedback');
        }

        if ($loginSuccess) {
            $view = 'LogoutView.php';
            require_once('./view/LayoutView.php');
        } else {
            $view = 'LoginView.php';
            require_once('./view/LayoutView.php');
        }
    }
}