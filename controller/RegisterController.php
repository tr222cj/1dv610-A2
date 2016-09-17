<?php

/**
 * Class RegisterController
 */
class RegisterController
{
    /** @var View view */
    private $view;

    /**
     * RegisterController constructor
     * Creates a new controller and renders its views
     */
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view = new View();

            $data = [
                "message" => Session::get('feedback'),
            ];

            $this->view->render('RegisterView', $data);
        }
    }
}