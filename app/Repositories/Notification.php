<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Notification
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
    /*public function getTalentByUserId($user_id) {
        $response = $this->client->get(env('API_URL').'getTalentByUserId?user='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }*/

    public function getNewNotifications() {
        $response = $this->client->get(env('API_URL').'notifications/'.session('user')->email."?token=".session('user')->token,
            array('form_params' => array())
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }

}