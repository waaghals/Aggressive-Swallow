<?php

namespace Aggressiveswallow\Queries;

use Aggressiveswallow\QueryInterface;

/**
 * Query the latest locations.
 *
 * @author Patrick
 */
class LatestLocationQuery
        extends BaseQuery
        implements QueryInterface {

    public function fetch() {

        if (empty($this->table)) {
            throw new \Exception("Table name not set.");
        }

        $this->condition = "LIMIT 3";
        $sql = sprintf("SELECT %s FROM `%s` %s", $this->fields(), $this->table, $this->condition);
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }
}
