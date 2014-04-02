<?php

namespace Aggressiveswallow\Models;

/**
 * A single user entity
 *
 * @author Patrick
 */
class User
        extends BaseEntity {

    private $name;
    private $passhash;
    private $salt;
    private $isAdmin;

    public function getName() {
        return $this->name;
    }

    public function getPasshash() {
        return $this->passhash;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPasshash($passhash) {
        $this->passhash = $passhash;
    }

    public function getPassHashForPassword($password) {
        if (!isset($this->salt)) {
            throw new \Exception("Salt needs to be set in order to change the pass.");
        }
        return hash("sha512", $this->salt . $password);
    }

    public function hasPassword($password) {
        $thisHash = $this->getPassHashForPassword($password);

        return $thisHash === $this->passhash;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

}
