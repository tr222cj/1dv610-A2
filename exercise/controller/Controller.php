<?php
declare (strict_types = 1);

namespace controller;

require_once('./core/Session.php');
require_once("./view/View.php");

use core\Session;

use view\View;

abstract class Controller {

    /** @var View view */
    protected $view;

    protected function __construct() {
        Session::start();

        if (Session::isConcurrentSession()) {
            session_regenerate_id(false);
            Session::destroy();
        }

        $this->view = new View();
    }
}
