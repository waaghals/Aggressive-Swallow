<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aggressiveswallow\Models\Enums;

/**
 * Description of LocationType
 *
 * @author Patrick
 */
class LocationType extends SplEnum {
    const __default = self::FamilyHouse;
    
    const FamilyHouse = 1;
    const Room = 2;
    const Appartment = 3;
    const Studio = 4;
    const Garage = 5;
    const ParkingSpace = 6;
}