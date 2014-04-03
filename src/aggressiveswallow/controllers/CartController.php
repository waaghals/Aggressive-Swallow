<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Tools\Container;

/**
 * Simple cart controller for adding and removing products from the cart
 *
 * @author Patrick
 */
class CartController
        extends BaseController {

    private $loginError;

    public function __construct() {
        $this->loginError = false;
    }

    public function showAction() {
        
    }

    public function addAction($locationId) {
        
    }

    public function removeAction($locationId) {
        
    }

}
