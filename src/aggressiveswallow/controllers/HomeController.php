<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Responses\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of HomeController
 *
 * @author Patrick
 */
class HomeController
        extends BaseController {

    public function indexAction() {
        return new ErrorResponse("Home::Index is not yet implented", Response::HTTP_NOT_IMPLEMENTED);
    }

}
