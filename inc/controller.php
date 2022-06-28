<?php

class User {
    
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    function set_username($username) {
        $this->username = $username;
    }
    function set_password($password) {
        $this->password = $password;
    }

    function get_username() {
        return $this->username;
    }
    function get_password() {
        return $this->password;
    }
}

