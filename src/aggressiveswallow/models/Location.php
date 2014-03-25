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

    function __construct($price, Category $category, Address $address, $description) {
        if (!is_int($price)) {
            throw new \InvalidArgumentException("\$price is not a valid integer.");
        }

        $this->price = $price;
        $this->category = $category;
        $this->address = $address;
        $this->description = $description;
    }

    /**
     * 
     * @return Aggressiveswallow\Models\Enums\Category
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
     * @param \Aggressiveswallow\Models\Enums\Category $category
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
