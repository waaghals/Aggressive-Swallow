<?php

namespace Aggressiveswallow\Models;

/**
 * BaseEntity for all models, every model should have an id.
 *
 * @author Patrick
 */
abstract class BaseEntity {

    /**
     *
     * @var int Primairy field
     */
    private $id;

    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param int $id
     * @throws \InvalidArgumentException when id is not an interger
     */
    public function setId($id) {
        if (!is_int($id)) {
            throw new \InvalidArgumentException("Not a valid Id was passed to setId on BaseEntity");
        }
        $this->id = $id;
    }

    abstract public function isValid();
}
