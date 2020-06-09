<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthenticatedUser extends Model
{
    protected $fillable = [
        'name', 'email', 'token', 'ip_address', 'mac_address', 'user_type'
    ];

    public function __construct(String $name, String $email, String $token, String $ip_address, String $mac_address, String $user_type) {
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
        $this->ip_address = $ip_address;
        $this->mac_address = $mac_address;
        $this->user_type = $user_type;
    }

    public function getType() {
        return $this->type;
    }
}
