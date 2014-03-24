<?php
namespace Aggressiveswallow\Models;

use Aggressiveswallow\Models\Enums\LocationType;

/**
 * Basic items of a product
 *
 * @author Patrick
 */
class Location {
    
    /**
     *
     * @var int Price in cents 
     */
    private $price;
    
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
    
    function __construct($price, LocationType $type, Address $address) {
        if(!is_int($price)){
            throw new \InvalidArgumentException("\$price is not a valid integer.");
        }
        
        if(!is_a($type, "LocationType")){
            throw new \InvalidArgumentException("\$type is not a valid LocationType.");
        }
        
        if(!is_a($address, "Address")){
            throw new \InvalidArgumentException("\$address is not a valid Address.");
        }
        
        $this->price = $price;
        $this->type = $type;
        $this->address = $address;
    }

}
