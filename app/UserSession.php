<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSession
{
    private $name = ''; 
    private $username = ''; 
    private $type = '';

    function __construct($name, $username, $type) {
        $this->name = $name;
        $this->username = $username;
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getName() {
        return $this->name;
    }
}