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
        if(isset($POST["submit"]) && $this->isValidRegistration()){
            $r = new Response();
            $r->mustRevalidate();
            $r->setLastModified();
            $r->setContent("Registration successfull", Response::HTTP_CREATED);
            return $r;
        }
        return $this->showRegistrationForm();
    }
    
    public function loginAction() {
        if(isset($POST["submit"]) && $this->isValidLogin()){
            $r = new Response();
            $r->mustRevalidate();
            $r->setLastModified();
            $r->setContent("Login successfull", Response::HTTP_CREATED);
            return $r;
        }
        return $this->showLoginForm();
    }
    
    private function showRegistrationForm(){
        $t = new Template("accountViews/registration");

        $repo = Container::make("GenericRepository");
        $latestQ = Container::make("latestLocationQuery");

        $t->locations = $repo->read($latestQ);
        $t->pageTitle = "Home";

        return new Response($t, 200);
    }
    
    private function showLoginForm(){
        $t = new Template("accountViews/login");

        $repo = Container::make("GenericRepository");
        $latestQ = Container::make("latestLocationQuery");

        $t->locations = $repo->read($latestQ);
        $t->pageTitle = "Home";

        return new Response($t, 200);
    }

    private function isValidRegistration() {
        
    }

    public function isValidLogin() {
        
    }

}
