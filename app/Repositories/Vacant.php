<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Vacant 
{
    protected $vacant;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getVacantAll() {
        $response = $this->client->get(env('API_URL').'jobs', array('form_params' => array('token' => session('user')->token)));
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }

    public function getVacantOne(String $vacant_id){
        $url = env('API_URL').'jobs/'.$vacant_id;
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

    public function addNewVacant($name, $title, $description = '', $requirements = '', $imagen = '', $category = '', $subcategory = '', $job_type = '', $level = '',  $city = '',  $state = '',  $country = '') {
        $dt2 = new Data2;
        //dd('name'.$name.'titl'.$title);
            $response = $this->client->post(
                env('API_URL').'jobs',
                array(
                    'form_params' => array(
                        'name' => $name,
                        'title' => $title,
                        'description' => $description,
                        'requirements' => $requirements,
                        'imagen' => ( !is_null($imagen) ? $this->imageLoader($imagen,'job','imagen',null)->message : null ),
                        'category' => $category,
                        'subcategory' => $subcategory,
                        'job_type' => $job_type,
                        'representant' => $dt2->getMyUserId(),
                        'level' => $level,
                        'city' => $city,
                        'state' => $state,
                        'country' => $country,
                        'token' => session('user')->token
                    )
                )
            );
            
            $resp = json_decode($response->getBody()->getContents()); 
            return $resp;
    }

    public function extraLoad($idvac) {
        // return "no";
        // $idvac
        $c = $this->getVacantOne($idvac)->category;
        $sc = $this->getVacantOne($idvac)->subcategory;
        //dd($this->getVacantAll());
        $vacs = array();
        foreach ($this->getVacantAll() as $nh) {
            if (property_exists($nh, 'category') && property_exists($nh, 'subcategory')) {
                $c = new City();
                $full_region_address = $c->getRegionalData($nh->_id);
                $foo = (array)$nh;
                $foo['complete_address'] = $full_region_address;
                $nh = (object)$foo;
                if ($nh->category== $c || $nh->subcategory== $sc) {
                    if ($nh->_id!=$idvac) {
                        array_push($vacs, $nh);   
                    }
                }
            }
        }
        return $vacs;
    }

    public function apply($job_id, $talent_id) {
        $url = env('API_URL').'get_user_b_email?email='.session('user')->email;
        $response = $this->client->get($url,array());
        $user_id = json_decode($response->getBody()->getContents());
        $user_id = $user_id->_id;
        $url2 = env('API_URL').'job_already_apply?talent_id='.session('user')->email."&job_id=".$job_id."&token=".session('user')->token;
        $response2 = $this->client->get($url2,array('form_params' => array('token' => session('user')->token)));
        $validateapply = json_decode($response2->getBody()->getContents());
        if ($validateapply->count > 0) {
            return json_encode((object)array('ResponseCode'=>0, 'ResponseData' => 'Already apply'));
        }else {
            $response = $this->client->post(
                env('API_URL').'aplications2',
                array(
                    'form_params' => array(
                        'job_id' => $job_id,
                        'talent' => session('user')->email,
                        'token' => session('user')->token
                    )
                )
            );
            return json_encode((object)array('ResponseCode'=>1, 'ResponseData' => 'Success'));
        }
    }

    // Agilizar la carga hacerlo en segundo plano
    protected function imageLoader($img,$modelo,$campo,$id) {
        if (!is_null($img)) {
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                env('API_URL').'image-storag',
                array(
                    'multipart' => [
                        [
                            'name'     => 'imagestorage',
                            'contents' => (!is_null($img) ? fopen($img->path(), 'r') : null)
                        ],
                        [
                            'name'     => 'model',
                            'contents' => $modelo
                        ],
                        [
                            'name'     => 'fd',
                            'contents' => $campo
                        ]
                    ]  
                )
            ); 
            $resp = json_decode($response->getBody()->getContents());
            return $resp; 
        }else {
            return false;
        }

    }
}
