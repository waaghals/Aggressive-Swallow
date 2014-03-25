<?php

namespace Aggressiveswallow\Repositories;

use Aggressiveswallow\PersistanceInterface;

/**
 * Repository for locations
 *
 * @author Patrick
 */
class GenericRepository
        extends BaseRepository {

    /**
     *
     * @var Aggressiveswallow\PersistanceInterface; 
     */
    private $persistor;

    public function __construct(PersistanceInterface $persistor) {
        $this->persistor = $persistor;
    }

    /**
     * Create a new object and persist it.
     * @param mixed $object to store
     * @return mixed $object with the Id set.
     * @throws \InvalidArgumentException When the object isn't valid
     * @throws \Exception When an unexpected object is in the entity.
     */
    public function create($object) {
        if (!$object->isValid()) {
            throw new \InvalidArgumentException("Location is not valid to be stored.");
        }

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
         if($object->getId() == null){
            throw new Exception("Can't delete \$object because it does not have a Id (PKey)");
        }
    }

    public function read($query) {
        if (!is_a($query, "Aggressiveswallow\QueryInterface")) {
            throw new Exception("\$query does not implement QueryInterface");
        }
    }

    public function update($object) {
        if($object->getId() == null){
            throw new Exception("Can't update \$object because does not have a Id (PKey)");
        }
        
        // Because create works recursively it has to work with existing id's as well
        // Use a create to update the object.
        return $this->create($object);
    }

}
