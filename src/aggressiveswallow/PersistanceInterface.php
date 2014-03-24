<?php
namespace Aggressiveswallow;

/**
 * Interface for storing data, doesn't matter if it is memory, db or file.
 * @author Patrick
 */
interface PersistanceInterface {
    function persist($data);
    function retreive($key);
}
