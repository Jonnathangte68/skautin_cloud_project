<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Statistic 
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
    public function getCountFollowers($user_id) {
        $response = $this->client->get(env('API_URL').'count_followers?usr='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getCountFollowing($user_id) {
        $response = $this->client->get(env('API_URL').'count_following?usr='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getCountViewers($user_id) {
        $response = $this->client->get(env('API_URL').'count_viewers?usr='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getCountConextions($user_id) {
        $response = $this->client->get(env('API_URL').'count_connections?usr='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
}