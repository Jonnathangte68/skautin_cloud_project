<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Enterprise 
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    // Only method, return (1) only enterprise
    public function getEnterprise() {
        $response = $this->client->get(env('API_URL').'getEnterprise');
        $resp = json_decode($response->getBody()->getContents());
        return $resp[0];
        /*if ($resp->success == false) {
            return 1;
        }elseif($resp->success == true){
            return 2;
        }*/
    }
}
