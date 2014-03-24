<?php

namespace Aggressiveswallow\Models\Enums;

/**
 * Category enums from the database.
 *
 * @author Patrick
 */
class Category {

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

}
