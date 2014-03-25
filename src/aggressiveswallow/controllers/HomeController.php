<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Persistors\DatabasePersistor;
use Aggressiveswallow\Models\Address;
use Aggressiveswallow\Models\Location;
use Aggressiveswallow\Models\Category;
use Aggressiveswallow\Repositories\GenericRepository;
use Aggressiveswallow\Queries\LatestLocationQuery;
use Aggressiveswallow\Queries\FullTreeQuery;

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
                "desc" => "Prachtig huis"),
            array(
                "street" => "Straat 3",
                "desc" => "Geef huis"),
            array(
                "street" => "Straat 4",
                "desc" => "Lelijk huis")
        );

        $t = new Template("homeViews/frontPage");
        $t->locations = $locations;
        return new Response($t, 200);
    }

    public function testAction() {
        $pdo = new \PDO("mysql:host=localhost;dbname=web2", "root", "", array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
        $persistor = new DatabasePersistor($pdo);
        $address = new Address("Street", "13b", "Nijmegen", "6543ZZ");
        $cat = new Category("Test");

        $loc = new Location(2435, $cat, $address, "Other House");


        $locRepo = new GenericRepository($persistor);
        $locRepo->create($loc);

        $body = sprintf("<pre>%s</pre>", print_r($loc, true));
        return new Response($body, 200);
    }

    public function test2Action() {
        $pdo = new \PDO("mysql:host=localhost;dbname=web2", "root", "", array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));

        $persistor = new DatabasePersistor($pdo);
        $locRepo = new GenericRepository($persistor);
        $query = new LatestLocationQuery($pdo);
        $query->setClassName("Aggressiveswallow\Models\Location");
        
        $result = $locRepo->read($query);
        $body = sprintf("<pre>%s</pre>", print_r($result, true));
        return new Response($body, 200);
    }

    public function test3Action() {
        $pdo = new \PDO("mysql:host=localhost;dbname=web2", "root", "", array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));

        $persistor = new DatabasePersistor($pdo);
        $locRepo = new GenericRepository($persistor);
        $query = new FullTreeQuery($pdo);
        $query->setClassName("Aggressiveswallow\Models\Tree");
        
        $results = $locRepo->read($query);
        $body = "<pre>";
        foreach ($results as $result) {
            $body .= $result->name . "\n";
        }
        $body .= "</pre>";
        //$body = sprintf("<pre>%s</pre>", print_r($result, true));
        return new Response($body, 200);
    }

}
