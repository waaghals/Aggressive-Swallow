<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aggressiveswallow\Queries;

/**
 * Description of TreeRootQuery
 *
 * @author Patrick
 */
class FullTreeQuery
        extends BaseQuery {

    public function fetch() {

        $treeQuery = new TreeLimitsQuery($this->connection);
        $treeQuery->setClassName("Aggressiveswallow\Models\Tree");

        $treeLimits = $treeQuery->fetch();
        

        $this->condition = sprintf("HAVING `lft` BETWEEN %s AND %s ORDER BY `lft` ASC", $treeLimits->min, $treeLimits->max);
        $sql = sprintf("SELECT %s FROM `%s` %s", $this->fields(), $this->table, $this->condition);
        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }

}
