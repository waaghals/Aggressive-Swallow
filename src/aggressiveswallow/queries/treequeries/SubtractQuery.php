<?php

namespace Aggressiveswallow\Queries\Treequeries;

use Aggressiveswallow\RunQueryInterface;

/**
 * Subtract 2 from the `lft` or `rgt` fields from the hierachy table
 *
 * @author Patrick
 */
class SubtractQuery
        extends TreeQuery
        implements RunQueryInterface {

    /**
     * Subtract 2 from every node where the fieldname is larger than the supplied id;
     */
    public function run() {
        $stmtLft = $this->connection->prepare(TreeQuery::SUB_LEFT);
        $stmtRgt = $this->connection->prepare(TreeQuery::SUB_RIGHT);
        $stmtLft->execute(array("id" => $this->id));
        $stmtRgt->execute(array("id" => $this->id));
    }

}
