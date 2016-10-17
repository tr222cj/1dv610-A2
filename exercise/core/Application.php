<?php
declare (strict_types = 1);

namespace core;

require_once('./controller/BaseController.php');
require_once('./controller/ErrorController.php');

require_once('./core/Session.php');
require_once('./core/Cookie.php');
require_once('./core/DatabaseFactory.php');

require_once("./view/BaseView.php");
require_once('./view/LoginView.php');
require_once('./view/RegisterView.php');
require_once('./view/ErrorView.php');

require_once('./model/UserModel.php');
require_once('./model/LoginModel.php');
require_once('./model/RegisterModel.php');
require_once('./model/UserDAL.php');
require_once('./model/UserDALMySql.php');

use controller\ErrorController;

final class Application {

    /**
     * Finds and executes init() on current controller
     * @throws \Exception
     */
    public function __construct() {
        // Start Session here so that we can use it from the start
        Session::start();

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
            if (Tool::isTestEnvironment()) {
                throw $e;
            } else {
                Session::setErrorMessage($e->getMessage());
                $controller = new ErrorController();
                $controller->init();
            }
        }
    }

    /**
     * Gets controller name from URL.
     * Example: http://localhost:8080/?register => Controller name = RegisterController
     * Default: LoginController
     *
     * @return string
     */
    private function getControllerName() : string {
        $controllerName = $this->getControllerNameFromQueryString();

        if (empty($controllerName)) {
            $controllerName = 'login';
        }

        $controllerName = ucfirst($controllerName) . 'Controller';

        return $controllerName;
    }

    /**
     * Gets first part of the controller name from QueryString.
     * Example: http://localhost:8080/?register => register
     * @return string
     */
    private function getControllerNameFromQueryString() : string {
        return explode('=', $_SERVER['QUERY_STRING'])[0];
    }
}
