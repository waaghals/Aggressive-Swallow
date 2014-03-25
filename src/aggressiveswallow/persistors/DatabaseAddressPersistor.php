<?php

namespace Aggressiveswallow\Persistors;

/**
 * Handles the persistance of Address entities in the database.
 *
 * @author Patrick
 */
class DatabaseAddressPersistor
        extends DatabasePersistor {

    public function persist($object) {
        $reflector = new \ReflectionObject($object);
        $fields = $reflector->getProperties();


        foreach ($fields as $field) {
            $fieldName = $field->getName();
            var_dump($fieldName);
            $methodName = sprintf("get%s", ucfirst($fieldName));
            $fieldValue = $reflector->getMethod($methodName)->invoke($object);

            $bindData[$fieldName] = $fieldValue;
        }

        // Does it exists in the database?
        // In others words, does it have an id.
        var_dump($bindData);
        if (isset($bindData["id"]) && $bindData["id"] != null) {
            // Id exist
            $this->update($bindData);
            return $bindData["id"];
        }
        $this->insert($bindData);
        return $this->connection->lastInsertId();
    }

    public function retreive($key) {
        return $this->select($key);
    }

    private function insert($bindData) {
        $fields = array_keys($bindData);
        // build query...
        $sql = "INSERT INTO address";

        // implode keys of $array...
        $sql .= " (`" . implode("`, `", $fields) . "`)";

        // implode values of $array...
        $sql .= " VALUES (:" . implode(", :", $fields) . ")";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($bindData);
    }

    private function update($bindData) {

        $sql = sprintf("UPDATE `%s` SET ", "address");
        $setters;
        foreach ($bindData as $field => $value) {
            if ($field === "id") {
                //Skip the id field, this is used in the where clause.
                continue;
            }
            $setters[] = sprintf("`%s` = :%s", $field, $field);
        }
        $sql .= implode(", ", $setters);
        $sql .= " WHERE `id` = :id";

        var_dump($sql);
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($bindData);
    }

    private function select($key) {
        die("TODO");
    }

}
