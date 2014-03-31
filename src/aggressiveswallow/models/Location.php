<?php

namespace Aggressiveswallow\Models;

use Aggressiveswallow\Models\Category;

/**
 * Basic items of a product
 *
 * @author Patrick
 */
class Location
        extends Product {

    /**
     *
     * @var Aggressiveswallow\Models\Enums\Category
     */
    private $category;

    /**
     *
     * @var Aggressiveswallow\Models\Address 
     */
    private $address;

    /**
     * 
     * @return Aggressiveswallow\Models\Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * 
     * @return Aggressiveswallow\Models\Address 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * 
     * @param \Aggressiveswallow\Models\Category $category
     */
    public function setCategory(Category $category) {
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
