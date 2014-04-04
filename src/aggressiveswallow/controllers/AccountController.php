<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Tools\Container;
use \Aggressiveswallow\Helpers\Loggedin;

/**
 * Description of HomeController
 *
 * @author Patrick
 */
class AccountController
        extends BaseController {

    private $loginError;

    /* @var $user \Aggressiveswallow\Models\User */
    private $user;

    public function __construct() {
        parent::__construct();
        $this->loginError = false;
    }

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

        if (isset($_POST["submit"]) && $this->isValidLogin()) {
            $r = new Response();
            $r->mustRevalidate();
            $r->setLastModified();
            $loggedin = Loggedin::SESSION_NAME;
            $this->session->$loggedin = $this->user;
            $r->setContent("<html><head><meta http-equiv='refresh' content='2;url=../../'></head><body>Login successfull, Welcome " . $this->user->getName(), Response::HTTP_ACCEPTED);

            return $r;
        } elseif (isset($_POST["submit"])) {
            $this->loginError = true;
        }

        return $this->showLoginForm();
    }

    public function logoutAction() {
        $loggedin = Loggedin::SESSION_NAME;
        $this->session->remove($loggedin);
        $r = new Response();
        $r->setContent("<html><head><meta http-equiv='refresh' content='2;url=../../'></head><body>Logout successfull", Response::HTTP_ACCEPTED);
        return $r;
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
        if ($this->loginError) {
            $t->error = "Gebruikersnaam of wachtwoord is verkeerd.";
        }

        $this->loginError = false;

        return new Response($t, 200);
    }

    private function isValidRegistration() {
        return true;
    }

    public function isValidLogin() {

        $repo = Container::make("genericRepository");
        $q = Container::make("userByNameQuery");
        $q->setName($_POST["name"]);

        $this->user = $repo->read($q);

        if ($this->user->getName() == null) {
            // No user found
            return false;
        }
        return $this->user->hasPassword($_POST["password"]);
    }

}
