<?php
declare (strict_types = 1);

namespace controller;

use core\Session;
use view\ErrorView;

final class ErrorController extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->view = new ErrorView();
    }

    public function init() {
        Session::setAction('error');

        $data = [
            'message' => Session::getErrorMessage(),
        ];

        $this->view->renderWithoutMenu('/error/index', $data);
    }
}
