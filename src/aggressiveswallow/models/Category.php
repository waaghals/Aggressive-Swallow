<?php

namespace Aggressiveswallow\Models;


/**
 * Category from the database.
 *
 * @author Patrick
 */
class Category
        extends BaseEntity {
    
    /**
     *
     * @var \Aggressiveswallow\Models\MenuItem
     */
    private $menuItem;

    public function isValid() {
        return strlen($this->name) > 1;
    }
    
    /**
     * 
     * @return \Aggressiveswallow\Models\MenuItem
     */
    public function getMenuItem() {
        return $this->menuItem;
    }

    /**
     * 
     * @param \Aggressiveswallow\Models\MenuItem $menuItem
     */
    public function setMenuItem(MenuItem $menuItem) {
        $this->menuItem = $menuItem;
    }
    
    /**
     * 
     * @return string category name
     */
    public function getName() {
        return $this->menuItem->getName();
    }

}
