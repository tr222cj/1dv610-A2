<?php
declare (strict_types = 1);

namespace view;

class LoginBaseView extends BaseView {

    protected static $loginName = 'LoginView::UserName';
    protected static $loginPassword = 'LoginView::Password';
    protected static $loginKeep = 'LoginView::KeepMeLoggedIn';
    protected static $loginMessage = 'LoginView::Message';
    protected static $loginDoLogin = 'LoginView::Login';
    protected static $loginDoLogout = 'LoginView::Logout';

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
}
