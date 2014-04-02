<?php

namespace Aggressiveswallow\Models;

use Aggressiveswallow\Models\MenuItem;

/**
 * Basic items of a product
 *
 * @author Patrick
 */
class Location
        extends Product {

    /**
     *
     * @var Aggressiveswallow\Models\MenuItem
     */
    private $category;

    /**
     *
     * @var Aggressiveswallow\Models\Address 
     */
    private $address;

    /**
     * 
     * @return Aggressiveswallow\Models\MenuItem
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * 
     * @return \Aggressiveswallow\Models\Address 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * 
     * @param \Aggressiveswallow\Models\MenuItem $category
     */
    public function setCategory(MenuItem $category) {
        $this->category = $category;
    }

    /**
     * 
     * @param \Aggressiveswallow\Models\Address $address
     */
    public function setAddress(Address $address) {
        $this->address = $address;
    }

    /**
     * 
     * @return boolean
     */
    public function isValid() {
        if (parent::isValid()) {
            return ($this->address != null);
        }
        return false;
    }

}
