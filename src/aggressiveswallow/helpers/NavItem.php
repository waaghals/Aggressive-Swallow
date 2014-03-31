<?php

namespace Aggressiveswallow\Helpers;

use Aggressiveswallow\Models\MenuItem;

/**
 * Holds the navigation structure
 *
 * @author Patrick
 */
class NavItem {

    /**
     *
     * @var array \Aggressiveswallow\Helpers\NavItem  
     */
    private $children;

    /**
     *
     * @var \Aggressiveswallow\Models\MenuItem 
     */
    private $menuItem;

    /**
     * 
     * @return \Aggressiveswallow\Helpers\NavItem
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * 
     * @param \Aggressiveswallow\Helpers\NavItem $child
     */
    public function addChild($child) {
        $this->children[] = $child;
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
     * @return string name from the menuItem
     */
    public function getName(){
        return $this->menuItem->getName();
    }
    
    /**
     * 
     * @return string URI from the menuItem
     */
    public function getUri() {
        return $this->menuItem->getUri();
    }
}
