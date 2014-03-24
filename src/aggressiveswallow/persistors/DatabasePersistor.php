<?php

namespace Aggressiveswallow\Persistors;

use Aggressiveswallow\PersistanceInterface;

/**
 * Description of DatabasePersistor
 *
 * @author Patrick
 */
abstract class DatabasePersistor
        implements PersistanceInterface {

    /**
     *
     * @var \PDO 
     */
    protected $connection;

    public function __construct(\PDO $connection) {
        $this->connection = $connection;
    }

}
