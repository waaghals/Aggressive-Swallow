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
class AccountController
        extends BaseController {

    public function registerAction() {
        if (isset($_POST["submit"]) && $this->isValidRegistration()) {
            $r = new Response();
            $r->mustRevalidate();
            $r->setLastModified();
            $r->setContent("Registration successfull", Response::HTTP_CREATED);
            return $r;
        }
        return $this->showRegistrationForm();
    }

    public function loginAction() {
        if (isset($_POST["submit"])) {
            $r = new Response();
            $r->mustRevalidate();
            $r->setLastModified();
            if ($this->isValidLogin()) {
                $r->setContent("Login successfull", Response::HTTP_ACCEPTED);
            }
            else {
                $r->setContent("Login FAILED", Response::HTTP_OK);
            }
            
            return $r;
        }
        return $this->showLoginForm();
    }

    private function showRegistrationForm() {
        $t = new Template("accountViews/registration");

        $repo = Container::make("GenericRepository");
        $latestQ = Container::make("latestLocationQuery");

        $t->locations = $repo->read($latestQ);
        $t->pageTitle = "Home";

        return new Response($t, 200);
    }

    private function showLoginForm() {
        $t = new Template("accountViews/login");

        $repo = Container::make("GenericRepository");
        $latestQ = Container::make("latestLocationQuery");

        $t->locations = $repo->read($latestQ);
        $t->pageTitle = "Home";

        return new Response($t, 200);
    }

    private function isValidRegistration() {
        return true;
    }

    public function isValidLogin() {
        $repo = Container::make("genericRepository");
        $q = Container::make("userByNameQuery");
        $q->setName($_POST["name"]);

        /* @var $user \Aggressiveswallow\Models\User */
        $user = $repo->read($q);
        return $user->hasPassword($_POST["password"]);
    }

}
