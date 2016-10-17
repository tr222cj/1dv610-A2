<?php
declare (strict_types = 1);

namespace controller;

use core\Session;

abstract class BaseController {

    protected $view;
    protected $model;

    protected function __construct() {
        if (Session::isConcurrentSession()) {
            session_regenerate_id(false);
            Session::destroy();
        }
    }

    abstract function init();
}
