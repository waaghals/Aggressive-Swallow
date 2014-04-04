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
class CheckoutController
        extends BaseController {

    /**
     *
     * @var \Aggressiveswallow\Helpers\Cart
     */
    private $cart;

    public function __construct() {
        parent::__construct();
        $this->initCart();
    }
    
    public function paymentAction() {
        $t = new Template("cartViews/payment");
        $t->cart = $this->cart;
        return new Response($t);
    }

    public function confirmAction() {
        if ($this->cart->isEmpty()) {
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
        $t = new Template("cartViews/success");
        $t->cart = clone $this->cart;
        $this->cart->destroy();
        
        return new Response($t);
    }

    private function initCart() {
        $cart_name = Cart::SESSION_NAME;

        if (!$this->session->has($cart_name)) {
            $this->session->$cart_name = Container::make("cart");
        }

        $this->cart = $this->session->$cart_name;
    }

}
