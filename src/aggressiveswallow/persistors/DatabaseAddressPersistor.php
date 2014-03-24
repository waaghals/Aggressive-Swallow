<?php

namespace Aggressiveswallow\Persistors;

use Aggressiveswallow\EntityPersistanceInterface;

/**
 * Handles the persistance of Address entities in the database.
 *
 * @author Patrick
 */
class DatabaseAddressPersistor
        extends DatabasePersistor
        implements EntityPersistanceInterface {

    public function persist($data) {

        // Does it exists in the database?
        // In others words, does it have an id.
        if ($data->getId() == null) {
            $this->insert($data);
            return;
        }
        $this->update($data);
    }

    public function retreive($key) {
        return $this->select($key);
    }

    public function getCreatedId() {
        return $this->connection->lastInsertId();
    }

    private function insert($data) {
        $sql = "INSERT INTO `address` (`street` ,`housenumber` ,`city` ,`zipcode`) VALUES (:street,  :housenumber,  :city,  '');";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array('name' => $name, 'description' => $description));
    }

    private function update($data) {
        
    }

    private function select($key) {
        
    }

}
