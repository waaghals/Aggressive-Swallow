<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Responses\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Models\Location;
use Aggressiveswallow\Models\Address;
use Aggressiveswallow\Models\MenuItem;
use Aggressiveswallow\Tools\Template;
use Aggressiveswallow\Tools\Container;

/**
 * Description of Location
 *
 * @author Patrick
 */
class LocationController
        extends BaseController {

    public function addAction() {
        return new ErrorResponse("Create action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

    public function showAction($locationId) {
        $repository = Container::make("GenericRepository");

        $locationQuery = Container::make("SingleLocationQuery");
        $locationQuery->setId((int) $locationId);

        /* @var $location \Aggressiveswallow\Models\Location */
        $location = $repository->read($locationQuery);

        $breadcrumsQuery = Container::make("breadcrumsQuery");
        $breadcrumsQuery->setMenuItem($location->getMenuItem());

        $t = new Template("locationViews/showLocation");
        $t->location = $location;
        $t->breadcrums = $repository->read($breadcrumsQuery);
        $t->pagetitle = $location->getAddress()->getFullStreetName();
        $t->cart = $this->session->cart;

        return new Response($t, 200);
    }

    public function editAction($locationId = null) {
        return new ErrorResponse("Update action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

    public function deleteAction($locationId = null) {
        return new ErrorResponse("Delete action not yet implented.", Response::HTTP_NOT_IMPLEMENTED);
    }

}
