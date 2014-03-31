<?php

namespace Aggressiveswallow\Factories;

use Aggressiveswallow\FactoryInterface;
use Aggressiveswallow\Helpers\NavItem;

/**
 * Description of NavItemFactory
 *
 * @author Patrick
 */
class NavItemFactory
        implements FactoryInterface {

    /**
     *
     * @var \Aggressiveswallow\Helpers\NavItem 
     */
    private $parent;

    /**
     *
     * @var int 
     */
    private $lastDepth;

    /**
     *
     * @var \Aggressiveswallow\Factories\MenuItemFactory 
     */
    private $menuItemFactory;

    public function __construct(MenuItemFactory $factroy) {
        $this->menuItemFactory = $factroy;
    }

    /**
     * 
     * @param splObject $data returned row from database
     * @return \Aggressiveswallow\Helpers\NavItem
     */
    public function create($data) {

        $data->depth = intval($data->depth);
        if (!isset($this->lastDepth)) {
            $this->lastDepth = $data->depth;
        }

        if ($this->lastDepth > $data->depth) {
            // Going back one level
            $this->parent = $this->parent->getChildren();
        }

        $menuItem = $this->menuItemFactory->create($data);

        $navItem = new NavItem();
        $navItem->setMenuItem($menuItem);

        if (!isset($this->parent)) {
            $this->parent = $navItem;
        } else {
            $this->parent->addChild($navItem);
        }

        if ($this->lastDepth < $data->depth) {
            //Going up one level
            $this->parent = $navItem;
        }

        return $navItem;
    }

}
