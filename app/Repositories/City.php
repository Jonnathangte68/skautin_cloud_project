<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class City 
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getRegionalData($vacant_id) {
    	$v = new Vacant();
    	$v = $v->getVacantOne($vacant_id);
    	$full_job_address = '';
    	if ($v->country) {
    		$country = new Country();
    		$country = $country->getCountryOne($v->country);
    		//dd($country->name);
    		$full_job_address .= $country->name;
    	}
    	if ($v->state) {
    		$state = new State();
    		$state = $state->getStateOne($v->state);
    		if ($full_job_address!="") {
    			$full_job_address .= ','.$state->name;
    		}else {
    			$full_job_address .= $state->name;
    		}
    	}
    	if ($v->city) {
    		$city = $this->getCityOne($v->city);
    		if ($full_job_address!="") {
    			$full_job_address .= ','.$city->name;
    		}else {
    			$full_job_address .= $city->name;
    		}
    	}
    	//dd($full_job_address);
    	return $full_job_address;
    }

    public function getCityOne($city_id) {
    	$url = env('API_URL').'citys/'. $city_id;
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
