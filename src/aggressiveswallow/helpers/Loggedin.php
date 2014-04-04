<?php

namespace Aggressiveswallow\Helpers;

use Aggressiveswallow\Models\User;

/**
 * Holds the user data
 *
 * @author Yorick
 */
class Loggedin {

    const SESSION_NAME = "loggedin";

    private $user;

    function __construct() {
        $this->items = new User();
    }

    /**
     * Add a logged in user
     * 
     */
    public function login(User $user) {

        $this->user = $user;
    }

    /**
     * Check if someone is already logged in
     * 
     * @return boolean
     */
    public function isLoggedin() {
        return isset($this->user);
    }
    /**
     * Get the account
     * 
     */
    public function getAccount() {
        return $this->user;
    }

}
