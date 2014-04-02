<?php

namespace Aggressiveswallow\Tools;

/**
 * IoC Container
 *
 * @author Patrick
 */
class Container {

    /**
     * @var array
     */
    protected static $registry = array();

    /**
     * Add a new resolver to the registry array.
     * @param  string $name Key
     * @param  \Closure $resolve Closure that will create the correct instance.
     */
    public static function register($name, \Closure $resolve) {
        static::$registry[$name] = $resolve;
    }

    /**
     * Find the closure by $name, then execute it and return te result.
     * @param  string $name The key to which the Closure was registered.
     * @return mixed
     */
    public static function make($name) {
        if (!static::isRegistered($name)) {
            $m = sprintf("No object with name \"%s\" was registered with the container.", $name);
            throw new \Exception($m);
        }

        $name = static::$registry[$name];
        return $name();
    }

    /**
     * Find if a \Closure is registerd with the key $name.
     * @param  string $name
     * @return boolean True if the key with $name exists
     */
    public static function isRegistered($name) {
        return array_key_exists($name, static::$registry);
    }

}
