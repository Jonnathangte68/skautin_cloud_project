<?php

namespace App\Repositories;

// all, showOne, edit, delete
class Chat
{

    /* /full-message-thread */
    public function all($email) {
        $client = new \GuzzleHttp\Client();
        $response = $client->get(
            env('API_URL').'user_message_list?email='.$email,
            array(
                'form_params' => array(
                    'token' => session('token'),
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }

    public function guardar($to, $from, $msg, $email_temp) {
        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            env('API_URL').'store_new_message_improved',
            array(
                'form_params' => array(
                    'receiver' => $to,
                    'sender' => $from,
                    'message' => $msg,
                    'email_temp' => $email_temp,
                    'token' => session('token')
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

    public function getChatMessageDetail($msg_id) {
        $client = new \GuzzleHttp\Client();
        $response = $client->get(
            env('API_URL').'get_single_message?mesage_id='.$msg_id,
            array(
                'form_params' => array(
                    'token' => session('token'),
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        if ($resp === NULL) {
            return 1;
        }else {
            return $resp->message;
        }
    }

    public function update($name, $description, $status,$id) {
        /*$client = new \GuzzleHttp\Client();
        $response = $client->put(
            env('API_URL').'pages/'.$id,
            array(
                'form_params' => array(
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                    'token' => session('token'),
                )
            )
        );
        $resp = json_decode($response->getBody()->getContents());
        if ($resp === NULL) {
            return 1;
        }else {
            return 0;
        }*/
    }

    public function findOne($id) {
       /* $client = new \GuzzleHttp\Client();
        $full_path = env('API_URL').'pages/'.$id.'/?token='.session('token');
        $response = $client->get($full_path);
        $resp = json_decode($response->getBody()->getContents());
        return $resp;*/
    }

    public function findOneByName($name) {
        /*$client = new \GuzzleHttp\Client();
        $full_path = env('API_URL').'pagesByName/'.$name;
        //dd($full_path);
        $response = $client->get($full_path);
        $resp = json_decode($response->getBody()->getContents());
        return $resp;*/
    }

    public function borrar($id) {
        /*$client = new \GuzzleHttp\Client();
        $response = $client->delete(env('API_URL').'pages/'.$id,array('form_params' => array('token' => session('token'))));
        $resp = json_decode($response->getBody()->getContents());
        if ($resp === NULL) {
            return 1;
        }else {
            return 0;
        }*/
    }
}
