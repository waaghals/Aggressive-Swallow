<?php
namespace Aggressiveswallow\Models;

/**
 * A address for a location.
 *
 * @author Patrick
 */
class Address {
    
    /**
     *
     * @var string Street name of object
     */
    private $street;
    
    /**
     *
     * @var string House number including the additive
     */
    private $houseNumber;
    
    /**
     *
     * @var string Name of the city or village.
     */
    private $city;
    
    /**
     *
     * @var string The zipcode for the location
     */
    private $zipcode;
    
    function __construct($street, $houseNumber, $city, $zipcode) {
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->city = $city;
        $this->zipcode = $zipcode;
    }

    
}
