<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class State 
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getStateOne($state_id) {
    	$url = env('API_URL').'states/'. $state_id;
        //dd($url);
        $response = $this->client->get($url, 
            array(
                'form_params' => array(
                    'token' => session('user')->token,
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
}
