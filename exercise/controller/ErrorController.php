<?php
declare (strict_types = 1);

namespace controller;

use core\Session;
use view\BaseView;

class ErrorController extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->view = new BaseView();
    }

    public function init() {
        Session::setAction('error');

        $this->view->renderError('/error/index');
    }
}
