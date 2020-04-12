<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Data2 
{
    protected $client;
    private $comparacion;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getMyVacants() {
        return [];  
    }

    public function getJobTypes() {
        $response = $this->client->get(env('API_URL').'jobtypes',
            array('form_params' => array('token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;        
    }

    public function getMyUserId() {
        $response = $this->client->get(env('API_URL').'userByEmail',array('form_params' => array('email' => session('user')->email)));
        $resp = json_decode($response->getBody()->getContents());
        return $resp->_id;    
    }

    public function addUsersConnection($a, $b) {
        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            env('API_URL').'addConnectionWeb',
            array(
                'form_params' => array(
                    'left' => $a,
                    'right' => $b,
                    'token' => session('token'),
                )
            )
        );
        return json_decode($response->getBody()->getContents());
    }

    protected function setComparacion(String $texto) {
        $this->comparacion = $texto;
    }

    protected function getComparacion() {
        return $this->comparacion;
    }

}