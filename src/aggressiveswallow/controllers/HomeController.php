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
        $locations = array(
            array(
                "street" => "Straat 1",
                "desc" => "Mooi huis"
            ),
            array(
                "street" => "Straat 2",
                "desc" => "Prachtig huis"
            ),
            array(
                "street" => "Straat 3",
                "desc" => "Geef huis"
            ),
            array(
                "street" => "Straat 3",
                "desc" => "Geef huis"
            ),
            array(
                "street" => "Straat 3",
                "desc" => "Geef huis"
            ),
            array(
                "street" => "Straat 3",
                "desc" => "Geef huis"
            ),
            array(
                "street" => "Straat 4",
                "desc" => "Lelijk huis"
            )
        );



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
