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

    /**
     *
     * @var \Aggressiveswallow\Factories\AddressFactory 
     */
    private $mif;

    /**
     *
     * @var \Aggressiveswallow\Factories\MenuItemFactory  
     */
    private $af;

    public function __construct(MenuItemFactory $mif, AddressFactory $af) {
        $this->mif = $mif;
        $this->af = $af;
    }

    public function create($data) {

        $location = new Location();
        $location->setId(intval($data["location_id"]));
        $location->setPrice($data["location_price"]);
        $location->setDescription($data["location_description"]);

        if (isset($data["menuitem_id"])) {
            $menuItem = $this->mif->create($data);
            $location->setCategory($menuItem);
        }

        if (isset($data["address_id"])) {
            $address = $this->af->create($data);
            $location->setAddress($address);
        }

        return $location;
    }

}
