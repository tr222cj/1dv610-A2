<?php
declare (strict_types = 1);

namespace core;

require_once("./core/View.php");

abstract class Controller {

    /** @var View view */
    protected $view;

    protected function __construct() {
        Session::start();

        if (Session::isConcurrentSession()) {
            Session::destroy();
        }

        $this->view = new View();
    }
}
