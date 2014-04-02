<?php

use Aggressiveswallow\Tools\Container;
use Aggressiveswallow\Persistors\DatabasePersistor;
use Aggressiveswallow\Factories\AddressFactory;
use Aggressiveswallow\Factories\LocationFactory;
use Aggressiveswallow\Factories\NavItemFactory;
use Aggressiveswallow\Factories\MenuItemFactory;
use Aggressiveswallow\Queries\FullNavigationQuery;
use Aggressiveswallow\Queries\LatestLocationQuery;
use Aggressiveswallow\Queries\SingleLocationQuery;
use Aggressiveswallow\Repositories\GenericRepository;

// Register the objects
Container::registerSingleton("db", function() {
    return new \PDO("mysql:host=localhost;dbname=web2", "root", "", array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ));
});

Container::register("persistor", function() {
    $db = Container::make("db");
    return new DatabasePersistor($db);
});

Container::register("genericRepository", function() {
    $persistor = Container::make("persistor");
    return new GenericRepository($persistor);
});

Container::register("menuItemFactory", function() {
    return new MenuItemFactory();
});

Container::register("navItemFactory", function() {
    $mif = Container::make("menuItemFactory");
    return new NavItemFactory($mif);
});

Container::register("navQuery", function() {
    $db = Container::make("db");
    $niv = Container::make("navItemFactory");
    return new FullNavigationQuery($db, $niv);
});

Container::register("addressFactory", function() {
    return new AddressFactory();
});

Container::register("locationFactory", function() {
    $mif = Container::make("menuItemFactory");
    $af = Container::make("addressFactory");
    return new LocationFactory($mif, $af);
});

Container::register("latestLocationQuery", function() {
    $db = Container::make("db");
    $factory = Container::make("locationFactory");
    return new LatestLocationQuery($db, $factory);
});

Container::register("singleLocationQuery", function() {
    $db = Container::make("db");
    $factory = Container::make("locationFactory");
    return new SingleLocationQuery($db, $factory);
});

Container::registerSingleton("navigation", function() {
    $repo = Container::make("GenericRepository");
    $navQ = Container::make("navQuery");
    
    $navRoot = $repo->read($navQ);
    return $navRoot->getChildren();
});
