<?php
declare (strict_types = 1);

namespace view;

final class View {

    // LoginView
    private static $loginName = 'LoginView::UserName';
    private static $loginPassword = 'LoginView::Password';
    private static $loginKeep = 'LoginView::KeepMeLoggedIn';
    private static $loginMessage = 'LoginView::Message';
    private static $loginDoLogin = 'LoginView::Login';
    private static $loginDoLogout = 'LoginView::Logout';

    // RegisterView
    private static $registerName = 'RegisterView::UserName';
    private static $registerPassword = 'RegisterView::Password';
    private static $registerPasswordRepeat = 'RegisterView::PasswordRepeat';
    private static $registerMessage = 'RegisterView::Message';
    private static $registerDoRegister = 'RegisterView::Register';

    /**
     * @param string $view
     * @param array $data
     * @throws \Exception
     */
    public function render(string $view, array $data = []) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        require('./view/layout/header.php');

        require('./view/layout/content.php');

        self::renderRequestedView($view);

        require('./view/layout/footer.php');
    }

    /**
     * @param string $view
     */
    public function renderError(string $view) {
        require('./view/layout/header.php');

        self::renderRequestedView($view);

        require('./view/layout/footer.php');
    }

    /**
     * @param string $view
     * @throws \Exception
     */
    private function renderRequestedView(string $view) {
        $view = './view/' . $view . '.php';

        if (file_exists($view)) {
            require($view);
        } else {
            throw new \Exception("View does not exist");
        }
    }

    // Login - get functions
    /**
     * @return string
     */
    public function getLoginName() : string {
        return $_POST[self::$loginName];
    }

    /**
     * @return string
     */
    public function getLoginPassword() : string {
        return $_POST[self::$loginPassword];
    }

    /**
     * @return bool
     */
    public function isLoginRememberMeSet() : bool {
        return isset($_POST[self::$loginKeep]);
    }

    /**
     * @return bool
     */
    public function isLoginAction() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[self::$loginDoLogin]);
    }

    /**
     * @return bool
     */
    public function isLogoutAction() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[self::$loginDoLogout]);
    }

    // Register - get functions
    /**
     * @return string
     */
    public function getRegisterName() : string {
        return $_POST[self::$registerName];
    }

    /**
     * @return string
     */
    public function getRegisterPassword() : string {
        return $_POST[self::$registerPassword];
    }

    /**
     * @return string
     */
    public function getRegisterPasswordRepeat() : string {
        return $_POST[self::$registerPasswordRepeat];
    }

    /**
     * @return bool
     */
    public function isRegisterAction() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[self::$registerDoRegister]);
    }
}
