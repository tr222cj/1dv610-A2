<?php

/**
 * Created by PhpStorm.
 * User: Tomas
 * Date: 2016-09-16
 * Time: 09:03
 */
class RegisterController
{
    /**
     * Renders the current view
     */
    public function render() {
        $view = 'RegisterView.php';
        require_once('./view/LayoutView.php');
    }
}