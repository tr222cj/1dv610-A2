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
    public function getUsername() : string {
        return $_POST[self::$loginName];
    }

    /**
     * @return string
     */
    public function getPassword() : string {
        return $_POST[self::$loginPassword];
    }

    /**
     * @return bool
     */
    public function isRememberMeSet() : bool {
        return isset($_POST[self::$loginKeep]);
    }

    /**
     * @return bool
     */
    public function isActionLogin() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[self::$loginDoLogin]);
    }

    /**
     * @return bool
     */
    public function isActionLogout() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[self::$loginDoLogout]);
    }
}
