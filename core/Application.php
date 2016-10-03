<?php
declare (strict_types = 1);

namespace core;

require_once('./core/Controller.php');

final class Application {

    public function __construct() {
        $controllerName = $this->getControllerName();
        $fileName = './controller/' . $controllerName . '.php';
        $controllerName = '\\controller\\' . $controllerName;

        if (file_exists($fileName)) {
            require_once($fileName);
            $controller = new $controllerName();
            $controller->init();
        } else {
            throw new \Exception("Controller does not exist");
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
