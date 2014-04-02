<?php

namespace Aggressiveswallow\Factories;

use Aggressiveswallow\FactoryInterface;
use Aggressiveswallow\Models\Address;
use Aggressiveswallow\Models\Location;

/**
 * Description of LocationFactory
 *
 * @author Patrick
 */
class LocationFactory
        implements FactoryInterface {

    public function create($data) {

        $location = new Location();
        $location->setId(intval($data["location_id"]));
        $location->setPrice($data["location_price"]);
        $location->setDescription($data["location_description"]);

        if (isset($data["menuitem_id"])) {
            $mif = new MenuItemFactory();
            $menuItem = $mif->create($data);
            $location->setCategory($menuItem);
        }
        
        if (isset($data["address_id"])) {
            $af = new AddressFactory();
            $address = $af->create($data);
            $location->setAddress($address);
        }

        return $location;
    }

}
