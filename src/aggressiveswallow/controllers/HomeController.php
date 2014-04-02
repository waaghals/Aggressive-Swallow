<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Persistors\DatabasePersistor;
use Aggressiveswallow\Repositories\GenericRepository;
use Aggressiveswallow\Queries\FullNavigationQuery;
use Aggressiveswallow\Factories\NavItemFactory;
use Aggressiveswallow\Factories\MenuItemFactory;
use Aggressiveswallow\Queries\LatestLocationQuery;
use Aggressiveswallow\Factories\LocationFactory;

/**
 * Description of HomeController
 *
 * @author Patrick
 */
class HomeController
        extends BaseController {

    public function indexAction() {
        $pdo = new \PDO("mysql:host=localhost;dbname=web2", "root", "", array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
        $persistor = new DatabasePersistor($pdo);
        $repo = new GenericRepository($persistor);
        $navigationRoot = $repo->read(new FullNavigationQuery($pdo, new NavItemFactory(new MenuItemFactory())));
        $latestLocations = $repo->read(new LatestLocationQuery($pdo, new LocationFactory()));

        $t = new Template("homeViews/frontPage");
        $t->locations = $latestLocations;

        $t->pageTitle = "Home";
        $t->nav = $navigationRoot->getChildren();

        return new Response($t, 200);
    }

}
