<?php

namespace Aggressiveswallow\Queries\Treequeries;

/**
 * Description of TreeQuery
 *
 * @author Patrick
 */
abstract class TreeQuery {

    const ADD_LEFT = "UPDATE `tree` SET `lft` = `lft` + 2 WHERE `lft` > :id";
    const ADD_RIGHT = "UPDATE `tree` SET `rgt` = `rgt` + 2 WHERE `rgt` >= :id";
    const SUB_LEFT = "UPDATE `tree` SET `lft` = `lft` - 2 WHERE `lft` > :id";
    const SUB_RIGHT = "UPDATE `tree` SET `rgt` = `rgt` - 2 WHERE `rgy` >= :id";

    protected $id;

    /**
     *
     * @var \PDO
     */
    protected $connection;

    public function __construct(\PDO $connection) {
        $this->connection = $connection;
    }

    public function setId($id) {
        $intval = intval($id);
        if (!is_int($intval)) {
            $m = sprintf("First agrument `id` in TreeQuery::setId should be an integer. Instead type `%s` was given.", gettype($id));
            throw new \Exception($m);
        }
        $this->id = $id;
    }

}
