<?php
declare (strict_types = 1);

namespace core;

require_once('./controller/Controller.php');
require_once('./controller/ErrorController.php');

use controller\ErrorController;

final class Application {

    public function __construct() {
        $controllerName = $this->getControllerName();
        $fileName = './controller/' . $controllerName . '.php';
        $controllerName = '\\controller\\' . $controllerName;

        try {
            if (file_exists($fileName)) {
                require_once($fileName);
                $controller = new $controllerName();
                $controller->init();
            } else {
                throw new \Exception("Controller does not exist");
            }
        } catch (\Exception $e) {
            if (Config::isTestEnvironment()) {
                throw $e;
            } else {
                $controller = new ErrorController();
                $controller->init();
            }
        }
    }

    private function getControllerName() : string {
        $controllerName = $this->splitQueryString();

        if (empty($controllerName)) {
            $controllerName = 'login';
        }

        $controllerName = ucfirst($controllerName) . 'Controller';

        return $controllerName;
    }

    private function splitQueryString() : string {
        return explode('=', $_SERVER['QUERY_STRING'])[0];
    }
}
