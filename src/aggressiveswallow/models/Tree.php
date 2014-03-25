<?php
namespace Aggressiveswallow\Models;

/**
 * Holds hierarchical data for in the database.
 *
 * @author Patrick
 */
class Tree
        extends BaseEntity {
    
    private $lft;
    
    private $rgt;
    
    public function isValid() {
        return is_int($lft) && is_int($rgt);
    }
}
