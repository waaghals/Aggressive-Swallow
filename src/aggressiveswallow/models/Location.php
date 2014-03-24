<?php

namespace Aggressiveswallow\Models;

use Aggressiveswallow\Models\Enums\Category;

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

    function __construct($price, Category $category, Address $address) {
        if (!is_int($price)) {
            throw new \InvalidArgumentException("\$price is not a valid integer.");
        }

        $this->price = $price;
        $this->category = $category;
        $this->address = $address;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
    }

    public function setAddress(Address $address) {
        $this->address = $address;
    }

    public function isValid() {
        if ($this->address != null && $this->category != null) {
            return true;
        }
        return false;
    }

}
