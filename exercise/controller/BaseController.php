<?php
declare (strict_types = 1);

namespace controller;

require_once('./core/Session.php');
require_once("./view/BaseView.php");

use core\Session;
use view\BaseView;

abstract class BaseController {

    /** @var BaseView view */
    protected $view;

    protected function __construct() {
        Session::start();

        if (Session::isConcurrentSession()) {
            session_regenerate_id(false);
            Session::destroy();
        }
    }

    abstract function init();
}
