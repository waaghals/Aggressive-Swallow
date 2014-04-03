<?php

namespace Aggressiveswallow\Helpers;

use Aggressiveswallow\Models\Product;

/**
 * Holds the cart data
 *
 * @author Patrick
 */
class Cart {

    private $items;

    function __construct() {
        $this->items = array();
    }

    public function add(Product $product) {
        $id = $product->getId();
        if ($id == null) {
            throw new \Exception("Product Id was not set. Not a valid product to be added to the cart.");
        }

        if ($this->has($product)) {
            throw new \Exception("Can not add the same product to the cart twice.");
        }

        $this->items[$id] = $product;
    }

    public function remove(Product $product) {
        if ($this->has($product)) {
            unset($this->items[$product->getId()]);
        }
    }

    public function has(Product $product) {
        return isset($this->items[$product->getId()]);
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($this->items as $item) {
            /* @var $item \Aggressiveswallow\Models\Product */
            $total += $item->getPrice();
        }
        
        return $total;
    }
    
    public function getFormattedTotalPrice() {
        $format = "&euro; %s,-";
        return sprintf($format, number_format($this->getTotalPrice(), 0, ",", "."));
    }
}
