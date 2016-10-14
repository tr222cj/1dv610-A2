<?php
declare (strict_types = 1);

namespace controller;

require_once('./core/Session.php');
require_once("./view/BaseView.php");

use core\Session;

abstract class BaseController {

    protected $view;
    protected $model;

    protected function __construct() {
        Session::start();

        if (Session::isConcurrentSession()) {
            session_regenerate_id(false);
            Session::destroy();
        }
    }

    abstract function init();
}
