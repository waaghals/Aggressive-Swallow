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
        implements EntityPersistanceInterface{

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
        if (is_array($data)) {
            $this->insertArray($data);
            return;
        }

        // Insert it as a object by default
        $this->insertObject($data);
    }

    private function insertObject($data) {
        if (!$data->isValid()) {
            throw new Exception("Object is not valid");
        }

        $bindData = array(
            "street" => $data->getStreet(),
            "housenumber" => $data->getHouseNumber(),
            "city" => $data->getCity(),
            "zipcode" => $data->getZipcode()
        );

        $this->insertArray($bindData);
    }

    private function insertArray($data) {
        $sql = "INSERT INTO `address` (`street`, `housenumber`, `city`, `zipcode`) VALUES (:street, :housenumber, :city, :zipcode)";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    private function update($data) {
        if (is_array($data)) {
            $this->updateArray($data);
            return;
        }

        // Insert it as a object by default
        $this->updateObject($data);
    }

    private function updateObject($data) {
        if (!$data->isValid()) {
            throw new Exception("Object is not valid");
        }

        $bindData = array(
            "street" => $data->getStreet(),
            "housenumber" => $data->getHouseNumber(),
            "city" => $data->getCity(),
            "zipcode" => $data->getZipcode()
        );

        $this->updateArray($bindData);
    }

    private function updateArray($data) {
        $sql = "UPDATE 
                    `address`   
                SET `street` = :street,
                    `housenumber` = :housenumber,
                    `city` = :city,
                    `zipcode` = :zipcode 
                 WHERE `id` = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    private function select($key) {
        die("TODO");
    }

}
