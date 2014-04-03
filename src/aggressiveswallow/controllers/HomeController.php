<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Tools\Container;

/**
 * Description of HomeController
 *
 * @author Patrick
 */
class HomeController
        extends BaseController {

    public function indexAction() {
        $t = new Template("homeViews/frontPage");

        $repo = Container::make("GenericRepository");
        $latestQ = Container::make("latestLocationQuery");
        $session = Container::make("session");

        $t->locations = $repo->read($latestQ);
        $t->pageTitle = "Home";
        $t->cart = $session->cart;

        return new Response($t, 200);
    }

}
