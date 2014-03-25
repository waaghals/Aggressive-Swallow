<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Persistors\DatabasePersistor;
use Aggressiveswallow\Models\Address;
use Aggressiveswallow\Models\Location;
use Aggressiveswallow\Models\Category;
use Aggressiveswallow\Repositories\LocationRepository;

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
        $cat = new Category("FamilyHouse");

        $loc = new Location(2435, $cat, $address, "Other House");

       
        $locRepo = new LocationRepository($persistor);
        $locRepo->create($loc);
        
        var_dump($loc);

        return new Response("", 200);
    }

}
