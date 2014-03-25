<?php
namespace Aggressiveswallow;

use Aggressiveswallow\Models\BaseEntity;

/**
 * Interface for CRUD actions
 * @author Patrick
 */
interface RepositoryInterface {
    function create($object);
    function read($query);
    function update($object);
    function delete($object);
}
