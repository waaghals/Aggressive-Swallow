<?php

namespace Aggressiveswallow\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Tools\Container;
use Aggressiveswallow\Helpers\Cart;
use Aggressiveswallow\Helpers\AjaxResponses\CartMessage;
use Aggressiveswallow\Tools\Responses\JsonResponse;
use Aggressiveswallow\Tools\Template;
use Aggressiveswallow\Tools\Responses\ErrorResponse;
use Aggressiveswallow\Models\Order;
use Aggressiveswallow\Models\User;

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
        parent::__construct();
        $this->repo = Container::make("genericRepository");
        $this->locationQuery = Container::make("singleLocationQuery");
        $this->initCart();
    }

    public function showAction() {
        $t = new Template("cartViews/overview");
        $t->cart = $this->cart;

        $body = "<pre>%s</pre>";
        $reponse = sprintf($body, print_r($this->cart->getItems(), true));
        return new Response($t);
    }

    public function addAction($locationId) {
        $responseObj = new CartMessage();
        $location = $this->getLocation($locationId);
        if ($this->cart->has($location)) {
            $responseObj->setHasError(true);
            $responseObj->setMessage("U heeft dit item al in de winkelwagen.");

            return new JsonResponse($responseObj);
        }

        $this->cart->add($location);
        $m = "%s is toegevoegd aan uw reacties.";
        $responseObj->setMessage(\sprintf($m, $location->getAddress()->getFullStreetName()));

        return new JsonResponse($responseObj);
    }

    public function removeAction($locationId) {
        $responseObj = new CartMessage();
        $location = $this->getLocation($locationId);
        if (!$this->cart->has($location)) {
            $responseObj->setHasError(true);
            $responseObj->setMessage("Het product om te verwijderen bestaat is niet in uw winkelwagen.");
            return new JsonResponse($responseObj);
        }

        $this->cart->remove($location);
        $m = "%s is verwijderd uit uw reactie lijst.";
        $responseObj->setMessage(sprintf($m, $location->getAddress()->getFullStreetName()));
        return new JsonResponse($responseObj);
    }

    public function buyAction() {
        if (!$this->cart->hasItems()) {
            return new ErrorResponse("De winkelwagen is leeg, dus er valt niets te kopen.");
        }

        $order = new Order();
        foreach ($this->cart->getItems() as $location) {
            /* @var $location \Aggressiveswallow\Models\Location */

            // Set the binding both ways.
            $location->setOrder($order);
            $order->addLocation($location);
        }
        $testUser = new User();
        $testUser->setId(1);
        $testUser->setName("Patrick");
        $testUser->setSalt("fdgsFtfRD45DSe#S%\$ÎFGVHJVSsdfgd");
        $order->setUser($testUser);

        $orderRepo = Container::make("orderRepository");
        /* @var $orderRepo \Aggressiveswallow\Repositories\OrderRepository */

        // Will update all the locations as well.
        $orderRepo->create($order);
    }

    private function initCart() {
        $cart_name = Cart::SESSION_NAME;

        if (!$this->session->has($cart_name)) {
            $this->session->$cart_name = Container::make("cart");
        }

        $this->cart = $this->session->$cart_name;
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

    public function debugAction() {
        $reponse = sprintf("<pre>%s</pre>", print_r($this->cart->getItems(), true));
        return new Response($reponse);
    }

}
