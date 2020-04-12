<?php

namespace App\Jobs;

//use App\User;
use GuzzleHttp\Client;
use App\Jobs\BinformationJob;
//use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreInformation extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $name;
    protected $gender;
    protected $yearofbirth;
    protected $country;
    protected $state;
    protected $category;
    protected $subcategory;
    protected $level;
    protected $profilepic;
    protected $user_id;

    public function __construct(String $name,String $gender,String $yearofbirth,String $country,String $state,String $category, String $subcategory, String $level, String $profilepic, String $user_id)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->yearofbirth = $yearofbirth;
        $this->country = $country;
        $this->state = $state;
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->level = $level;
        $this->profilepic = $profilepic;
        $this->user_id = $user_id;
    }

    public function handle()
    {
        $response = $this->client->post(
            'http://192.168.1.80:3002/store_talent',
            array(
                'form_params' => array(
                    'name' => $name,
                    'gender' => $gender,
                    'yearofbirth' => $yearofbirth,
                    'country' => $country,
                    'state' => $state,
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'level' => $level,
                    'profilepic' => $profilepic,
                    'user_id' => $user_id
                )
            )
        );
    }
}