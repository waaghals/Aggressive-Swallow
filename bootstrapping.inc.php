<?php

use Aggressiveswallow\Tools\Autoloader;

/**
 * @def (string) DS - Directory separator.
 */
define("DS", "/", true);

/**
 * @def (resource) BASE_PATH - get a base path.
 */
define('BASE_PATH', realpath(dirname(__FILE__)) . DS, true);

setlocale(LC_ALL, 'nl_NL');

require BASE_PATH . "src" . DS . "aggressiveswallow" . DS . "tools" . DS . "autoloader.php";

$loader = new Autoloader();
$loader->setSourceLocation("src");
$loader->register();

require 'register.inc.php';