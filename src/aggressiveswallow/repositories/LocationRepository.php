<?php

namespace Aggressiveswallow\Repositories;

use Aggressiveswallow\Models\Location;
use Aggressiveswallow\QueryInterface;

/**
 * Repository for locations
 *
 * @author Patrick
 */
class LocationRepository
        extends BaseRepository {

    /**
     *
     * @var Aggressiveswallow\PersistanceInterface; 
     */
    private $addressPersistor;

    /**
     *
     * @var Aggressiveswallow\PersistanceInterface; 
     */
    private $locationPersistor;

    public function __construct(
    PersistanceInterface $addressPersistor, PersistanceInterface $locationPersistor) {
        $this->addressPersistor = $addressPersistor;
        $this->locationPersistor = $locationPersistor;
    }

    public function create(Location $loc) {
        if (!$loc->isValid()) {
            throw new \InvalidArgumentException("Location is not valid to be stored.");
        }

        $this->addressPersistor->persist($data);
        
    }

    public function delete(Location $object) {
        
    }

    public function read(QueryInterface $query) {
        
    }

    public function update(Location $object) {
        
    }

}
