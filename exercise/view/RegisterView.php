<?php
declare (strict_types = 1);

namespace view;

class RegisterView extends BaseView {

    protected static $registerName = 'RegisterView::UserName';
    protected static $registerPassword = 'RegisterView::Password';
    protected static $registerPasswordRepeat = 'RegisterView::PasswordRepeat';
    protected static $registerMessage = 'RegisterView::Message';
    protected static $registerDoRegister = 'RegisterView::Register';

    /**
     * @return string
     */
    public function getUsername() : string {
        return $_POST[self::$registerName];
    }

    /**
     * @return string
     */
    public function getPassword() : string {
        return $_POST[self::$registerPassword];
    }

    /**
     * @return string
     */
    public function getPasswordRepeat() : string {
        return $_POST[self::$registerPasswordRepeat];
    }

    /**
     * @return bool
     */
    public function isActionRegister() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[self::$registerDoRegister]);
    }
}
