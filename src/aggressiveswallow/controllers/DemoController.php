<?php

namespace Aggressiveswallow\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Persistors\DatabasePersistor;
use Aggressiveswallow\Models\Address;
use Aggressiveswallow\Models\Location;
use Aggressiveswallow\Models\Category;
use Aggressiveswallow\Models\Tree;
use Aggressiveswallow\Repositories\GenericRepository;
use Aggressiveswallow\Repositories\TreeRepository;
use Aggressiveswallow\Queries\LatestLocationQuery;
use Aggressiveswallow\Queries\FullTreeQuery;
use Aggressiveswallow\Queries\Treequeries\AddQuery;
use Aggressiveswallow\Queries\Treequeries\SubtractQuery;
use Aggressiveswallow\Queries\NavigationQuery;
use Aggressiveswallow\Factories\NavItemFactory;
use Aggressiveswallow\Factories\MenuItemFactory;

/**
 * Description of HomeController
 *
 * @author Patrick
 */
class DemoController
        extends BaseController {

    private $body;
    private $pdo;
    
    public function __construct() {
        $this->pdo = new \PDO("mysql:host=localhost;dbname=web2", "root", "", array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
    }

    public function persistanceAction() {
        $persistor = new DatabasePersistor($this->pdo);
        $address = new Address("Street", "13b", "Nijmegen", "6543ZZ");
        $cat = new Category("Test");

        $loc = new Location(2435, $cat, $address, "Other House");


        $locRepo = new GenericRepository($persistor);
        $locRepo->create($loc);

        $body = sprintf("<pre>%s</pre>", print_r($loc, true));
        return new Response($body, 200);
    }

    public function hydrateAction() {
        $persistor = new DatabasePersistor($this->pdo);
        $locRepo = new GenericRepository($persistor);
        $query = new LatestLocationQuery($this->pdo);
        $query->setClassName("Aggressiveswallow\Models\Location");

        $result = $locRepo->read($query);
        $body = sprintf("<pre>%s</pre>", print_r($result, true));
        return new Response($body, 200);
    }

    public function addTreeAction() {
        $persistor = new DatabasePersistor($this->pdo);
        $repo = new TreeRepository($persistor);
        $repo->setQueries(new AddQuery($this->pdo), new SubtractQuery($this->pdo));
        $query = new FullTreeQuery($this->pdo);
        $query->setClassName("Aggressiveswallow\Models\Tree");

        $results = $repo->read($query);
        $body = "<pre>";
        foreach ($results as $result) {
            $body .= $result->name;


            if ($result->name == 17) {
                $body .="<<";
                $newNode = new Tree();
                $newNode->setParent($result);

                var_dump($repo->create($newNode));
            }

            $body .= "\n";
        }
        $body .= "</pre>";
        //$body = sprintf("<pre>%s</pre>", print_r($result, true));
        return new Response($body, 200);
    }

    public function navTreeAction() {
        $persistor = new DatabasePersistor($this->pdo);
        $repo = new GenericRepository($persistor);
        $navTree = $repo->read(new NavigationQuery($this->pdo, new NavItemFactory(new MenuItemFactory())));

        $this->body = "";
        $this->showTree($navTree);
        return new Response($this->body, Response::HTTP_OK);
    }

    private function showTree($tree) {
        $this->body .= "<ul>";
        if (!is_array($tree)) {
            $tree = array($tree);
        }

        foreach ($tree as $node) {
            /* @var $node \Aggressiveswallow\Helpers\NavItem */

            $children = $node->getChildren();

            $this->body .= "<li>" . $node->getName() . "</li>";
            if (count($children) > 0) {
                $this->showTree($children);
            }
        }
        $this->body .= "</ul>";
    }

}