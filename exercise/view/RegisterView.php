<?php
declare (strict_types = 1);

namespace view;

class RegisterBaseView extends BaseView {

    protected static $registerName = 'RegisterView::UserName';
    protected static $registerPassword = 'RegisterView::Password';
    protected static $registerPasswordRepeat = 'RegisterView::PasswordRepeat';
    protected static $registerMessage = 'RegisterView::Message';
    protected static $registerDoRegister = 'RegisterView::Register';

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
