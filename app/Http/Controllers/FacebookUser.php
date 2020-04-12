<?php

namespace App\Http\Controllers;

use App\Repositories\Enterprise;
use Request;
use App\User; // you need to define the model appropriately
use Facebook\Facebook;
use App\Repositories\Data;
use App\Repositories\FacebookModel;
//use App\Repositories\Facebook;

class FacebookUser extends Controller
{
    public function store(Facebook $fb) //method injection
    {
        // retrieve form input parameters
        //$uid = Request::input('uid');
        $user = session()->get('user')->email;
        $access_token = Request::input('access_token');
        $permissions = Request::input('permissions');
        $oAuth2Client = $fb->getOAuth2Client();
        $storeAccessToken = $oAuth2Client->getLongLivedAccessToken($access_token)->getValue();
        $fb->setDefaultAccessToken($storeAccessToken);
        $fields = "id,cover,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified";
        $fb_user = $fb->get('/me?fields='.$fields)->getGraphUser();
        $uidDao = new Data;
        $facebookDao = new FacebookModel;
        $userUid = $uidDao->getUserByEmailNew();
        $facebookDao->setAccessToken($storeAccessToken, $userUid->_id);
        // Done processing...
        return redirect()->action('TalentController@settingsAccount');
        /*$data = array();
        $ep = new Enterprise;
        $option_number = 0;
        array_push($data, $ep->getEnterprise());
        array_push($data, $option_number);
        $logedInUser = $uidDao->getUserByEmailNew();
        $facebook_token = true;
        if (!isset($logedInUser->fbAuthToken) || empty($logedInUser->fbAuthToken))
            $facebook_token == false;
        $data['facebook_token'] = $facebook_token;
        return view('talent.settings_account')->with('data',$data);*/
        //dd($fb_user);
        // assuming we have a User model already set up for our database
        // and assuming facebook_id field to exist in users table in database
        //$user = User::firstOrCreate(['facebook_id' => $uid]);
        // get long term access token for future use
        //$oAuth2Client = $fb->getOAuth2Client();
        //$storeAccessToken = $oAuth2Client->getLongLivedAccessToken($access_token)->getValue();
        // assuming access_token field to exist in users table in database
        //$user->access_token = $oAuth2Client->getLongLivedAccessToken($access_token)->getValue();
        //$user->save();
        // set default access token for all future requests to Facebook API
        //$fb->setDefaultAccessToken($user->access_token);
        // call api to retrieve person's public_profile details
        //$fields = "id,cover,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified";
        //$fb_user = $fb->get('/me?fields='.$fields)->getGraphUser();
        //dd($fb_user);
    }

    public function getFbFriends(Facebook $fb) {
        $facebookDao = new FacebookModel;
        $datax = new Data;
        $u = $datax->getUserByEmailNew();
        $userAccessToken = $facebookDao->getAccessToken($u->_id);
        $fb->setDefaultAccessToken($userAccessToken);
        try {

            $friends = $fb->post('/me/messages',$userAccessToken);
            return json_encode( $friends );
        } catch (FacebookApiException $e) {

            print_r(error_log($e));
        }
    }
}