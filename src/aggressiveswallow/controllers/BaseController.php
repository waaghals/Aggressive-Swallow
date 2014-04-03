<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Exceptions;
use Aggressiveswallow\Tools\Container;

/**
 * Description of baseController
 *
 * @author Patrick
 */
abstract class BaseController {

    protected $session;

    public function __construct() {
        $this->session = Container::make("session");
    }

    /**
     * Call a controller action with named arguments.
     * @param string $actionName
     * @param array $arguments
     * @return mixed value of the called method
     */
    public function callAction($actionName, array $arguments = array()) {
        try {
            $reflection = new \ReflectionMethod($this, $actionName);
        } catch (\Exception $e) {
            $msg = sprintf("Action \"%s\" does not exist.", $actionName);
            throw new Exceptions\ServerException($msg, Exceptions\ServerException::NOT_FOUND);
        }

        $pass = array();

        //Build the arguments array in the order of actual method arguments
        foreach ($reflection->getParameters() as $param) {
            $key = $param->getName();

            if (isset($arguments[$key])) {
                $pass[] = $arguments[$key];
            } else {
                $pass[] = $param->getDefaultValue();
            }
        }

        //Actually run the method/action
        $actionResponse = $reflection->invokeArgs($this, $pass);

        if (!is_a($actionResponse, "Symfony\Component\HttpFoundation\Response")) {
            $msg = sprintf("Did not receive a valid response from controller action: %s", $actionName);
            throw new \Exception($msg);
        }

        return $actionResponse;
    }

}
