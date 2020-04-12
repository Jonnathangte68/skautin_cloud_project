<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Talent 
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
    public function getTalentsAll() {
        $response = $this->client->get(env('API_URL').'talents', array('form_params' => array('token' => session('user')->token)));
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getOpenJobsXTalent($email) {
    	//dd("From email: ".$email);
        $response = $this->client->get(env('API_URL').'get_talent_by_user_email?&email='.$email, null);
        $user = json_decode($response->getBody()->getContents());
   $response2 = $this->client->get(env('API_URL').'get_jobs_publicity_categories_subcategories?categories='.http_build_query($user->category).'&subcategories='.http_build_query($user->subcategory));
      $content = json_decode($response2->getBody()->getContents());
      foreach($content as $c) {
        $newDate = date_create_from_format('d-m-Y H:i', $c->date);
        $c->date = $newDate->format('m-d-Y H:i:s');
      }
      return $content;
    }
    public function getId() {
        //dd(session('user')->email);
        $response = $this->client->get(env('API_URL').'get_talent_by_user_email?email='.session('user')->email, null);
        $resp = json_decode($response->getBody()->getContents());
        //dd($resp->_id);
        return $resp->_id;
    }
    public function edit($id, $country, $state, $city, $name, $gender, $birth_year, $level) {
        // API_ROUTE: /update_talent_details_from_wsk
        $response = $this->client->get(
            'http://localhost:3002'
            . '/update_talent_details_from_wsk?_id='.$id.'&countryId='.$country.'&stateId='.$state.'&cityId='.$city.'&name='.$name.'&gender='.$gender.'&birth_year='.$birth_year.'&level='.$level,
            array(
                'form_params' => array(
                    '_id' => $id,
                    'countryId' => $country,
                    'stateId' => $state,
                    'cityId' => $city,
                    'name' => $name,
                    'gender' => $gender,
                    'birth_year' => $birth_year,
                    'level' => $level,
                    'token' => session('token'),
                )
            )
        );
        $resp = $response->getBody()->getContents();
        //$resp = json_decode($response->getBody()->getContents());
        return $resp;
        /*if ($resp === NULL) {
            return 1;
        }else {
            return 0;
        }
        return $country;*/
    }
    public function updateImage($img) {
        $img_uploaded_name = $this->imageLoader($img,'talent','profile_img',null)->message;
        $response = $this->client->get(env('API_URL').'update_talent_img?email='.session('user')->email.'&image='.$img_uploaded_name, array());
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function updateUserPass($user, $oldPass, $newPass) {
        $req = $this->client->post(env('API_URL').'changeUserPasswordTwo',
            array(
                'form_params' => array(
                    'usr' => $user,
                    'p' => $oldPass,
                    'pass' => $newPass,
                    'token' => session('user')->token
                )));
        $res = json_decode($req->getBody()->getContents());
        return $res;
    }
    public function getRelatedVideos() {
        $response = $this->client->get(
            env('API_URL').'getTalentsVideosRandomList?recruiter_id='.session('user')->email, 
            []
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
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
