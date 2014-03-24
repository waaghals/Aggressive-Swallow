<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Responses\ErrorResponse;
use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;

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

}
