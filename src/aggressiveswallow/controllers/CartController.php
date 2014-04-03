<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Tools\Container;
use Aggressiveswallow\Helpers\Cart;
use Aggressiveswallow\Repositories\BaseRepository;
use Aggressiveswallow\Queries\SingleLocationQuery;

/**
 * Simple cart controller for adding and removing products from the cart
 *
 * @author Patrick
 */
class CartController
        extends BaseController {

    /**
     *
     * @var \Aggressiveswallow\Helpers\Cart
     */
    private $cart;

    /**
     *
     * @var \Aggressiveswallow\Repositories\BaseRepository; 
     */
    private $repo;

    /**
     *
     * @var \Aggressiveswallow\Queries\SingleLocationQuery;
     */
    private $locationQuery;

    public function __construct() {
        $this->repo = Container::make("genericRepository");
        $this->locationQuery = Container::make("singleLocationQuery");
        $this->initCart();
    }

    public function showAction() {
        $body = "<pre>%s</pre>";

        return new Response(sprintf($body, print_r($this->cart->getItems(), true)));
    }

    public function addAction($locationId) {
        $location = $this->getLocation($locationId);
        if (!$this->cart->has($location)) {
            //Show error
        }

        $this->cart->add($location);

        return new Response("Product Added");
    }

    public function removeAction($locationId) {
        $location = $this->getLocation($locationId);
        if (!$this->cart->has($location)) {
            //Show error
        }
        $this->cart->remove($location);
    }

    private function initCart() {
        $session = Container::make("session");
        $cart_name = Cart::SESSION_NAME;

        if (!$session->has($cart_name)) {
            $session->$cart_name = Container::make("cart");
        }

        $this->cart = $session->$cart_name;
    }

    private function getLocation($locationId) {
        $id = intval($locationId);
        if ($id < 1) {
            throw new \Exception("Not a valid \$locationId was given.");
        }

        $this->locationQuery->setId($locationId);
        $location = $this->repo->read($this->locationQuery);

        if (is_null($location)) {
            throw new \Exception(sprinf("No location exists with id %s", $id));
        }

        return $location;
    }

}
