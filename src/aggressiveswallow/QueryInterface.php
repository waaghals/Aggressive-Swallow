<?php
namespace Aggressiveswallow;

/**
 * Simple interface for data retreival.
 * @author Patrick
 */
interface QueryInterface {
    function fetch();
    function __construct(array $fields);
    function setFields(array $fields);
    function setField($field);
}
