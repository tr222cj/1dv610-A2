<?php

class LoginController {

    /**
     * Renders the current view
     */
    public function render() {
        $message = '';
        $username = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['LoginView::UserName'])) {
                $message = 'Username is missing';
            } elseif (empty($_POST['LoginView::Password'])) {
                $message = 'Password is missing';
                $username = $_POST['LoginView::UserName'];
            } else {
                // Try login
            }
        }

        // Require current view
        require_once('./view/LoginView.php');
    }
}