<?php

namespace Aggressiveswallow\Queries\Treequeries;

use Aggressiveswallow\RunQueryInterface;
use Aggressiveswallow\Queries\Treequeries\TreeQuery;

/**
 * Add 2 from the `lft` or `rgt` fields from the hierachy table
 *
 * @author Patrick
 */
class AddQuery
        extends TreeQuery
        implements RunQueryInterface {
    
    /**
     * Add 2 from every node where the fieldname is larger than the supplied id;
     */
    public function run() {
        $stmtLft = $this->connection->prepare(TreeQuery::ADD_LEFT);
        $stmtRgt = $this->connection->prepare(TreeQuery::ADD_RIGHT);
        $stmtLft->execute(array("id" => $this->id));
        $stmtRgt->execute(array("id" => $this->id));
    }

}
