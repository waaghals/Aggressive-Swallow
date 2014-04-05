<?php

namespace Aggressiveswallow\Controllers;

use Aggressiveswallow\Tools\Template;
use Symfony\Component\HttpFoundation\Response;
use Aggressiveswallow\Tools\Container;
use Aggressiveswallow\Helpers\LoginHelper as Login;

/**
 * Description of HomeController
 *
 * @author Patrick
 */
class AccountController
        extends BaseController {

    private $error;

    public function __construct() {
        $this->error = null;
        parent::__construct();
    }

    public function registerAction() {
        if (isset($_POST["submit"])) {
            $existingUser = Login::getUserByName($_POST["username"]);
            if (!is_null($existingUser)) {
                $this->error = "Gebruikersnaam bestaat al.";
            } else if ($_POST["password"] !== $_POST["password2"]) {
                $this->error = "Wachtwoorden komen niet overeen.";
            } else if (\strlen($_POST["password"]) < 4) {
                $this->error = "Wachtwoord is tekort.";
            } else if (!isset($_POST["tos"])) {
                $this->error = "U bent vergeten het vakje aan te vinken.";
            } else {
                /* @var $userFactory \Aggressiveswallow\Factories\UserFactory 
                 * @var $repo \Aggressiveswallow\Repositories\GenericRepository
                 */
                $userFactory = Container::make("userFactory");
                $repo = Container::make("genericRepository");
                $user = $userFactory->createFromUserAndPass($_POST["username"], $_POST["password"]);
                $repo->create($user);

                return new Response("Registration successfull", Response::HTTP_CREATED);
            }
        }
        return $this->showRegistrationForm();
    }

    public function loginAction() {
        if (isset($_POST["submit"]) && Login::isValidLogin($_POST["username"], $_POST["password"])) {

            $this->session->user = Login::getUserByName($_POST["username"]);
            $this->session->isLoggedIn = true;
            $this->session->regenerateId();

            return new Response("Login successfull", Response::HTTP_ACCEPTED);
        } elseif (isset($_POST["submit"])) {
            $this->error = "Gebruikersnaam of wachtwoord is verkeerd.";
        }

        return $this->showLoginForm();
    }

    public function logoutAction() {
        $this->session->isLoggedin = false;
        $this->session->destroy();
        return new Response("Logout successfull", Response::HTTP_ACCEPTED);
    }

    private function showRegistrationForm() {
        $t = new Template("accountViews/registration");
        if (!is_null($this->error)) {
            $t->error = $this->error;
        }

        return new Response($t, 200);
    }

    private function showLoginForm() {

        $t = new Template("accountViews/login");
        if (!is_null($this->error)) {
            $t->error = $this->error;
        }

        $this->error = false;

        return new Response($t, 200);
    }

}
