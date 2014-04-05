<?php

namespace Aggressiveswallow\Helpers;

use Aggressiveswallow\Models\Location;

/**
 * Helpers for creating buttons
 *
 * @author Patrick
 */
class buttonHelper {

    public static function addToCart(Location $location, Cart $cart) {
        $link = "/cart/add/locationId=%s/";
        $button = "<a href=\"%s\" class=\"btn btn-primary ajax-reload\" %s>%s</a>";
        if (!is_null($cart)) {
            if ($cart->has($location)) {
                return \sprintf($button, "#", "disabled=\"disabled\"", "In winkelwagen");
            }
        }
        $uri = sprintf($link, $location->getId());
        return \sprintf($button, $uri, "", "<span class=\"glyphicon glyphicon-shopping-cart\"></span> Kopen");
    }

}
