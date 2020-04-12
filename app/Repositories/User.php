<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class User 
{
    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function ingresar($username, $password,$ip) {
        //$request->session()->regenerate();
        $response = $this->client->post(
            env('API_URL').'authenticate',
            array(
                'form_params' => array(
                    'email' => $username,
                    'password' => $password
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());

        if ($resp->success == false and $resp->message == "Authentication failed. User not found.") {
            return 1;
        }elseif($resp->success == false){
            return 2;
        }else {
            // Correcto guardar session
            $ses_str_unescape = ''.$username.$resp->token.$ip.''.$this->getType($username);
            $ses_str = preg_replace("/[^a-zA-Z]+/", "", $ses_str_unescape);
            $this->client->post(env('API_URL').'createAuthData',array('form_params' => array('username' => $username,'ip_address' => $ip,'token' => $resp->token,'ses_chunk' => $ses_str,)));
            session(['token' => $resp->token]);
            
            return 3;
        }
    }

    public function registrar($username, $password) {
        $response = $this->client->post(
            env('API_URL').'sign-up',
            array(
                'form_params' => array(
                    'email' => $username,
                    'password' => $password
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());  
        if ($resp->success==true) {
            return true;
        }
        elseif($resp->success==false) {
            return false;
        }      
        // Verificar si existe -- Si existe enviar mensaje que ya esta registrado sino registrar
        // Luego registrar datos como talento o como reclutador
    }

    public function registrarTalento($username, $password, $name, $birth_year, $gender, $country, $state, $city, $level, $category, $subcategory,$pic) {
        $address = array('country' => $country, 'state' => $state, 'city' => $city);
        $json_address = json_encode($address);
        if ($pic or $pic!= '' or $pic != null) {
            //$this->imageLoader($pic,'talent','profile_img',null)->message;
            $response = $this->client->post(
                env('API_URL').'store-user-talent',
                array(
                    'form_params' => array(
                        'email' => $username,
                        'password' => $password,
                        'name' => $name,
                        'birth_year' => $birth_year,
                        'gender' => $gender,
                        'address' => $json_address,
                        'level' => $level,
                        'profile_img' => $this->imageLoader($pic,'talent','profile_img',null)->message,
                        'category' => $category,
                        'subcategory' => $subcategory
                    )
                )
            );
        }else {
            //$this->imageLoader($pic,'talent','profile_img',null)->message;
            $response = $this->client->post(
                env('API_URL').'store-user-talent',
                array(
                    'form_params' => array(
                        'email' => $username,
                        'password' => $password,
                        'name' => $name,
                        'birth_year' => $birth_year,
                        'gender' => $gender,
                        'address' => $json_address,
                        'level' => $level,
                        'category' => $category,
                        'subcategory' => $subcategory
                    )
                )
            );            
        }
         
        //$dt_class = new Data;
        //$dt_class
        $resp = json_decode($response->getBody()->getContents());  
        if ($resp->success==true) {
            return true;
        }
        elseif($resp->success==false) {
            return false;
        }      
        // Verificar si existe -- Si existe enviar mensaje que ya esta registrado sino registrar
        // Luego registrar datos como talento o como reclutador
    }

    public function registrarReclutador($username, $password, $name, $yearofbirth, $gender, $country, $state, $city, $type, $pic, $organization, $organization_website, $organization_phone, $category, $subcategory, $ages, $interestgender, $level) {
        $address = array('country' => $country, 'state' => $state, 'city' => $city);
        $json_address = json_encode($address);

        //dd($json_address);
        //dd($pic);
        if ($pic or $pic!= '' or !is_null($pic)) {
            $response = $this->client->post(
                env('API_URL').'store-user-recruiter',
                array(
                    'form_params' => array(
                        'email' => $username,
                        'password' => $password,
                        'name' => $name,
                        'address' => $json_address,
                        'birth_year' => $yearofbirth,
                        'gender' => $gender,
                        'recruitertype' => $type,
                        //'profile_image' => $pic,
                        'profile_image' => $this->imageLoader($pic,'recruiter','profile_image',null)->message,
                        'website' => $organization_website,
                        'phone_number' => $organization_phone,
                        'oname' => $organization,
                        'category' => $category,
                        'subcategory' => $subcategory,
                        'ages' => $ages,
                        'interestgender' => $interestgender,
                        'level' => $level,
                    )
                )
            );           
        }else {
            $response = $this->client->post(
                env('API_URL').'store-user-recruiter',
                array(
                    'form_params' => array(
                        'email' => $username,
                        'password' => $password,
                        'name' => $name,
                        'address' => $json_address,
                        'birth_year' => $yearofbirth,
                        'gender' => $gender,
                        'recruitertype' => $type,
                        //'profile_image' => $pic,
                        'website' => $organization_website,
                        'phone_number' => $organization_phone,
                        'oname' => $organization,
                        'category' => $category,
                        'subcategory' => $subcategory,
                        'ages' => $ages,
                        'interestgender' => $interestgender,
                        'level' => $level,
                    )
                )
            );
        }

        $resp = json_decode($response->getBody()->getContents());  
        if ($resp->success==true) {
            return true;
        }
        elseif($resp->success==false) {
            return false;
        }      
        // Verificar si existe -- Si existe enviar mensaje que ya esta registrado sino registrar
        // Luego registrar datos como talento o como reclutador
    }

    public function getType($username){
        $response = $this->client->get(env('API_URL').'getUserType',array('form_params' => array('email' => $username)));
        $resp = json_decode($response->getBody()->getContents());
        //dd($resp);
        return $resp->message;
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    //if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    //}
                }
            }
        }
    }

    public function isLogged($rq){
        // Check Token
        // If token exists, check is in the same ip address, and with the same user
        // Check If Session Data is correct!
        // Return true or false
        //dd(session('user')->token);
        //dd("Aq");
        //$u = session('user');
        //dd($u);
        if (is_null(session('user')) or empty(session('user'))) {
            return false;
        }else {
            //$ses_str_unescape = $u->name.$u->email.$u->token.$u->ip_address.$u->mac_address.$u->user_type;
            $ses_str_unescape = session('user')->name.session('user')->email.session('user')->token.session('user')->ip_address.session('user')->mac_address.session('user')->user_type;
            $ses_str = preg_replace("/[^a-zA-Z]+/", "", $ses_str_unescape);
            //dd($ses_str);
            $client = new \GuzzleHttp\Client();
            $response = $client->post(env('API_URL').'testtAuthRight',array('form_params' => array('token' => session('user')->token, 'username'=> session('user')->email, 'ip_address' => $rq, 'ses_chunk' => $ses_str)));
            $resp = json_decode($response->getBody()->getContents());
            //dd($ses_str);
            //dd($resp);
            if ($resp->success==true and $resp->message=="done") {
                if(session('user')->user_type==='t'){
                    return true;
                }else{
                    return false;
                }
            }
            else {return false;}
        }
    }

    public function isLoggedR($rq){
        // Check Token
        // If token exists, check is in the same ip address, and with the same user
        // Check If Session Data is correct!
        // Return true or false
        //dd(session('user')->token);
        //dd("Aq");
        //$u = session('user');
        //dd($u);
        if (is_null(session('user')) or empty(session('user'))) {
            return false;
        }else {
            //$ses_str_unescape = $u->name.$u->email.$u->token.$u->ip_address.$u->mac_address.$u->user_type;
            $ses_str_unescape = session('user')->name.session('user')->email.session('user')->token.session('user')->ip_address.session('user')->mac_address.session('user')->user_type;
            $ses_str = preg_replace("/[^a-zA-Z]+/", "", $ses_str_unescape);
            //dd($ses_str);
            $client = new \GuzzleHttp\Client();
            $response = $client->post(env('API_URL').'testtAuthRight',array('form_params' => array('token' => session('user')->token, 'username'=> session('user')->email, 'ip_address' => $rq, 'ses_chunk' => $ses_str)));
            $resp = json_decode($response->getBody()->getContents());
            //dd($ses_str);
            //dd($resp);
            if ($resp->success==true and $resp->message=="done") {
                if(session('user')->user_type==='r'){
                    return true;
                }else{
                    return false;
                }
            }
            else {return false;}
        }
    }

    public function changePrivateStatus($id) {
        $response = $this->client->post(
            env('API_URL').'changePrivateStatus',
            array(
                'form_params' => array(
                    'id' => $id,
                    'token' => session('user')->token
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        if ($resp != NULL) {
            return 0;
        }
        else {
            return 1;
        }
    }

    public function changeStatus($id) {
        $response = $this->client->post(
            env('API_URL').'changeStatus',
            array(
                'form_params' => array(
                    'id' => $id,
                    'token' => session('user')->token
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        if ($resp != NULL) {
            return 0;
        }
        else {
            return 1;
        }
    }

    // Agilizar la carga hacerlo en segundo plano
    protected function imageLoader($img,$modelo,$campo,$id) {
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
    }
}
