<?php

require_once('./model/LoginModel.php');

/**
 * Class LoginController
 */
class LoginController {

    /** @var View view */
    private $view;

    /**
     * LoginController constructor
     * Creates a new controller and renders its views
     */
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view = new View();

            if (!Session::isUserLoggedIn() && Cookie::isCookiesSet()) {
                LoginModel::isValidCookieLogin(Cookie::get('LoginView::CookieName'), Cookie::get('LoginView::CookiePassword'));
            }

            $data = [
                'message' => Session::get('feedback'),
                'username' => Session::get('username'),
                'csrfToken' => Tools::generateCsrfToken(),
            ];

            if (Session::get('isUserLoggedIn')) {
                $this->view->render('LogoutView', $data);
            }

            $this->view->render('LoginView', $data);
        }

        if (isset($_POST['LoginView::Logout'])) {
            $csrfToken = $_POST['LoginView::CsrfToken'];

            if (Tools::validateCsrfToken($csrfToken)) {
                if (Session::isUserLoggedIn()) {
                    LoginModel::logout();
                }

                header('Location: ' . $_SERVER['REQUEST_URI']);
            } else {
                header('Location: ' . '?error');
            }

            exit();
        }

        if (isset($_POST['LoginView::Login'])) {
            $csrfToken = $_POST['LoginView::CsrfToken'];

            if (Tools::validateCsrfToken($csrfToken)) {
                $username = $_POST['LoginView::UserName'];
                $password = $_POST['LoginView::Password'];
                $remember = isset($_POST['LoginView::KeepMeLoggedIn']);
                LoginModel::login($username, $password, $remember);

                header('Location: ' . $_SERVER['REQUEST_URI']);
            } else {
                header('Location: ' . '?error');
            }

            exit();
        }
    }
}