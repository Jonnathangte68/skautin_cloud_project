<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class FacebookModel
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getAccessToken($user) {
        $url = env('API_URL').'user/'. $user ."/?token=".session('user')->token;
        $response = $this->client->get($url,
            array(
                'form_params' => array(
                    'token' => session('user')->token,
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp->fbAuthToken;
    }

    public function setAccessToken($token, $id) {
        $response = $this->client->post(
            env('API_URL').'saveFbUserToken',
            array(
                'form_params' => array(
                    'uid' => $id,
                    'fbAuthToken' => $token,
                    'token' => session('token'),
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        if ($resp === NULL) {
            return 1;
        }else {
            return 0;
        }
    }
}
