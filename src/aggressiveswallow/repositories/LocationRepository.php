<?php

namespace Aggressiveswallow\Repositories;

use Aggressiveswallow\Models\BaseEntity;
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
    private $persistor;

    /**
     *
     * @var Aggressiveswallow\PersistanceInterface; 
     */
    private $locationPersistor;

    public function __construct(\Aggressiveswallow\Persistors\DatabasePersistor $persistor) {
        $this->persistor = $persistor;
    }

    /**
     * 
     * @param mixed $object
     * @return mixed $object with the Id set.
     * @throws \InvalidArgumentException When the object isn't valid
     * @throws \Exception When an unexpected object is in the entity.
     */
    public function create($object) {
        if (!$object->isValid()) {
            throw new \InvalidArgumentException("Location is not valid to be stored.");
        }
        ///////////////TODO start transaction
        $reflector = new \ReflectionObject($object);
        $fields = $reflector->getProperties();
        $bindData = array();

        foreach ($fields as $field) {
            $fieldName = $field->getName();
            $methodName = sprintf("get%s", ucfirst($fieldName));
            $method = $reflector->getMethod($methodName);
            $fieldValue = $method->invoke($object);

            if (is_object($fieldValue)) {
                $fieldReflector = new \ReflectionObject($fieldValue);
                $isBaseEntity = $fieldReflector->isSubclassOf("Aggressiveswallow\Models\BaseEntity");

                if (!$isBaseEntity) {
                    throw new \Exception("Unexpected object in Entity, value isn't subclass of baseEntity'");
                }

                // The returned value from the method is a baseEntity.
                // This means it is a foreignkey to an other field.
                // Persist that entity first, then use that id for the foreignkey.
                $this->create($fieldValue);

                $bindData[$fieldName . "_id"] = $fieldValue->getId();
            } else {
                // Just a plain type
                $bindData[$fieldName] = $fieldValue;
            }
        }

        $this->persistor->setTableName($reflector->getShortName());
        $idForObject = $this->persistor->persist($bindData);
        $object->setId($idForObject);
        return $object;
    }

    public function delete($object) {
        
    }

    public function read($query) {
        if (!is_a($query, "Aggressiveswallow\QueryInterface")) {
            throw new Exception("\$query does not implement QueryInterface");
        }
    }

    public function update($object) {
        
    }

}
