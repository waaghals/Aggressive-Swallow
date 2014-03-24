<?php
namespace Aggressiveswallow\Models;

use Aggressiveswallow\Models\Enums\LocationType;

/**
 * Basic items of a product
 *
 * @author Patrick
 */
class Location extends Product{

    /**
     *
     * @var Aggressiveswallow\Models\Enums\LocationType 
     */
    private $type;
    
    /**
     *
     * @var Aggressiveswallow\Models\Address 
     */
    private $address;
    
    function __construct($price, $type, Address $address) {
        if(!is_int($price)){
            throw new \InvalidArgumentException("\$price is not a valid integer.");
        }
        
        if(!is_int($type)){
            throw new \InvalidArgumentException("\$type is not a valid LocationType.");
        }
        
        $this->price = $price;
        $this->type = $type;
        $this->address = $address;
    }

    public function getType() {
        return $this->type;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setType(LocationType $type) {
        $this->type = $type;
    }

    public function setAddress(Address $address) {
        $this->address = $address;
    }



}
