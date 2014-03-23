<?php

require 'bootstrapping.inc.php';

use Aggressiveswallow\Tools\Request;
use Aggressiveswallow\Tools\Router;
use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;

//Perform the router magic, call the correct controller and action
//based on the uri
try {
    $request = new Request();
    $router = new Router();
    $router->setAutoloader($loader);
    
    $response = $router->handle($request);
    $response->send();

} catch (Exception $e) {
    $t = new Template("errors/Fatal");
    $t->message = $e->getMessage();
    $t->code = Response::HTTP_INTERNAL_SERVER_ERROR;
    $t->type = Response::$statusTexts[$t->code];

    $response = new Response($t, $t->code);
    $response->send();
}