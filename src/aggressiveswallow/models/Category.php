<?php

namespace Aggressiveswallow\Models;

/**
 * Category enums from the database.
 *
 * @author Patrick
 */
class Category
        extends BaseEntity {

    /**
     *
     * @var string Name of the category
     */
    private $name;

    function __construct($name) {
        $this->setName($name);
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function isValid() {
        return strlen($this->name) > 1;
    }

}
