<?php
declare (strict_types = 1);

namespace controller;

use core\Session;

class ErrorController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        Session::set('action', 'error');

        $this->view->renderError('/error/index');
    }
}