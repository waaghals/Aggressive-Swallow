<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aggressiveswallow\Queries;

use Aggressiveswallow\Models\MenuItem;
use Aggressiveswallow\Factories\NavItemFactory;
use Aggressiveswallow\Helpers\NavItem;

/**
 * Description of TreeRootQuery
 *
 * @author Patrick
 */
class NavigationQuery
        extends BaseQuery {
    
    /**
     *
     * @var \Aggressiveswallow\Factories\NavItemFactory 
     */
    private $factory;

    public function __construct(\PDO $connection, NavItemFactory $factory) {
        parent::__construct($connection);
        $this->factory = $factory;
    }
    

    public function fetch() {
        
        $sql = file_get_contents(BASE_PATH . "src/aggressiveswallow/queries/sqlfiles/SelectNavigation.sql");
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        
        $root = null;
        foreach ($stmt->fetchAll(\PDO::FETCH_OBJ) as $row) {
            $navItem = $this->factory->create($row);
            
            if(!isset($root)){
                $root = $navItem;
            }
        }
        
        return $root;
    }
}
