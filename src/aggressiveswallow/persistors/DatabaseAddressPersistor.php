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
        $reflector = new \ReflectionObject($data);
        $fields = $reflector->getProperties();


        foreach ($fields as $field) {
            $fieldName = $field->getName();
            $methodName = sprintf("get%s", ucfirst($fieldName));
            $fieldValue = $reflector->getMethod($methodName)->invoke($data);

            $bindData[$fieldName] = $fieldValue;
        }

        // Does it exists in the database?
        // In others words, does it have an id.
        if (isset($bindData["id"]) && $bindData["id"] != null) {
            // Id exist
            $this->update($bindData);
            return;
        }
        $this->insert($bindData);
    }

    public function retreive($key) {
        return $this->select($key);
    }

    public function getCreatedId() {
        return $this->connection->lastInsertId();
    }

    private function insert($data) {
        $fields = array_keys($data);
        // build query...
        $sql = "INSERT INTO table";

        // implode keys of $array...
        $sql .= " (`" . implode("`, `", $fields) . "`)";

        // implode values of $array...
        $sql .= " VALUES (':" . implode("', :'", $fields) . "');";

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
