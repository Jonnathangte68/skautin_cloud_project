<?php

namespace App\Repositories;

use GuzzleHttp\Client;
//use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class Video
{
    protected $video;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function add($name, $description, $video) {

        //dd(session('user'));

        $response = $this->client->post(env('API_URL').'new-video', 
            ['multipart' => [
                    [
                        'name'     => 'filetoupload',
                        'contents' => fopen($video->path(), 'r'),
                        'content-type' => "video/mp4",
                    ],
                    [
                    'name'     => 'name',
                    'contents' => $name
                    ],
                    [
                    'name'     => 'description',
                    'contents' => $description
                    ],
                    [
                    'name'     => 'username',
                    'contents' => session('user')->email
                    ],
                ]   
            ]);
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getVCatalog() {
        $response = $this->client->get(env('API_URL').'videocatalogs', array('form_params' => array('token' => session('user')->token)));
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getVCatalogById($id) {
        $response = $this->client->get(env('API_URL').'videocatalogs/'.$id, array('form_params' => array('token' => session('user')->token)));
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getVideoById($video_id) {
        $string_video = env('API_URL').'videos/'.$video_id;
        $response = $this->client->get($string_video, array('form_params' => array('token' => session('user')->token)));
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }


}
