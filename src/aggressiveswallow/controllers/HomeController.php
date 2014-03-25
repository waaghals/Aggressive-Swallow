<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Persistors\DatabaseAddressPersistor;
use Aggressiveswallow\Models\Address;

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
        $pdo = new \PDO("mysql:host=localhost;dbname=web2", "root", "");
        $persistor = new DatabaseAddressPersistor($pdo);
        $address = new Address("update", "13a", "Arnhem", "6843DX");
        $address->setId(14);
        var_dump($address);
        $persistor->persist($address);
        
        return new Response("", 200);
    }

}
