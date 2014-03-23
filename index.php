<?php

require 'bootstrapping.inc.php';

use Aggressiveswallow\Tools\Request;
use Aggressiveswallow\Tools\Router;

//Perform the router magic, call the correct controller and action
//based on the uri
try {
    $req = new Request();
    Router::match($req);
} catch (ServerException $e) {
    echo sprintf("<h1>Error: %s</h1>", HeaderHelper::getStatus($e->getCode()));
    echo sprintf("<p>Message: %s</p>", $e->getMessage());
    HeaderHelper::show($e->getCode());
}