<?php

namespace Aggressiveswallow\Models;

use Aggressiveswallow\Models\MenuItem;

/**
 * Basic items of a product
 *
 * @author Patrick
 */
class Location
        extends Product {

    /**
     *
     * @var Aggressiveswallow\Models\MenuItem
     */
    private $category;

    /**
     *
     * @var Aggressiveswallow\Models\Address 
     */
    private $address;

    /**
     *
     * @var string 
     */
    private $energyLabel;

    /**
     *
     * @var int
     */
    private $area;

    /**
     *
     * @var int
     */
    private $yardArea;

    /**
     *
     * @var boolean
     */
    private $newBuild;

    /**
     * 
     * @return Aggressiveswallow\Models\MenuItem
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * 
     * @return \Aggressiveswallow\Models\Address 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * 
     * @param \Aggressiveswallow\Models\MenuItem $category
     */
    public function setCategory(MenuItem $category) {
        $this->category = $category;
    }

    /**
     * 
     * @param \Aggressiveswallow\Models\Address $address
     */
    public function setAddress(Address $address) {
        $this->address = $address;
    }

    /**
     * 
     * @return boolean
     */
    public function isValid() {
        if (parent::isValid()) {
            return ($this->address != null);
        }
        return false;
    }

    public function getEnergyLabel() {
        return $this->energyLabel;
    }

    public function setEnergyLabel($energyLabel) {
        $validLabels = array("a", "b", "c", "d");
        if (!in_array($energyLabel, $validLabels)) {
            throw new \Exception("Not a valid label passed to setEnergyLabel");
        }
        $this->energyLabel = $energyLabel;
    }

    public function getArea() {
        return intval($this->area);
    }

    public function getYardArea() {
        return intval($this->yardArea);
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function setYardArea($yardArea) {
        $this->yardArea = $yardArea;
    }

    public function getNewBuild() {
        return (bool) $this->newBuild;
    }

    public function setNewBuild($newBuild) {
        $this->newBuild = $newBuild;
    }

}
