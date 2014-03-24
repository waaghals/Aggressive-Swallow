<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Responses\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of Location
 *
 * @author Patrick
 */
class LocationController
        extends BaseController {

    public function createAction() {
        return new ErrorResponse("Create action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

    public function readAction($locationId = null) {
        return new ErrorResponse("Read action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

    public function updateAction($locationId = null) {
        return new ErrorResponse("Update action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

    public function deleteAction($locationId = null) {
        return new ErrorResponse("Delete action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

}
