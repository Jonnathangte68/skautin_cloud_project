<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Enterprise;
use App\Repositories\Video;
use App\Repositories\Data;
use App\Repositories\Data2;
use App\Repositories\Country;
use App\Repositories\State;
use App\Repositories\City;
use App\Repositories\Statistic;

class PublicoController extends Controller
{
    public function welcome() {
        return view('welcome');
    }
    
    public function authenticateGuest() {
        return view('welcome_from_the_dark_internet');
    }

    public function validateEntrance (Request $request) {
        $userId = strval($request->input("userID"));
        if ($userId === "000000000003") {
            $request->session()->put('authenticatedEntrance', 'true');
            return json_encode(
                array(
                    'status' => true, 
                    'result' => 'success'
                )
            );
        } else {
            return json_encode(
                array(
                    'status' => false, 
                    'result' => 'error'
                )
            );
        }  
    }

    public function validateToken(String $tok) {
    	if(!empty($tok)){
    		dd($tok);
    		// Busco la data del usuario almacenado con esa clave y lo envio al servicio para guardar
    	}else {return abort(404);}
    }

    public function checkTk() {
        if (empty(session('user')) || empty(session('user')->email) || empty(session('user')->token)) {
            return json_encode(array('result' => false));
        }else {
            return json_encode(array('result' => true));
        }
    }

    public function viewTalentProfile(Request $request) {
        $data = array();
		$ep = new Enterprise;
        $video = new Video;
        $hiddenDao = new Data;
        $statisticDao = new Statistic;
        $vc = $video->getVCatalog();
        $vall = array();
        $maskId = $hiddenDao->checkExistReplaceUrlHidden($request->input('qMby'));
        $windowData = $hiddenDao->getUserDetails($maskId->url);
        $addrData = $hiddenDao->addressGetter($windowData->address);
        if(!empty($addrData)) {
            $address_string = "";
            $countryDao = new Country;
            $stateDao = new State;
            $cityDao = new City;
            if($addrData->country != null && !empty($countryDao->getCountryOne($addrData->country))) {
                $address_string .= $countryDao->getCountryOne($addrData->country)->name;
            }
            if($addrData->state != null && !empty($stateDao->getStateOne($addrData->state))) {
                $address_string .= ", ".$stateDao->getStateOne($addrData->state)->name;
            }
            if($addrData->city != null && !empty($cityDao->getCityOne($addrData->city))) {
                $address_string .= ", ".$cityDao->getCityOne($addrData->city)->name;
            }
        }
    	array_push($data, $ep->getEnterprise());
        array_push($data, $vall);
        $data['talent_id'] = $windowData->_id;
        $data['talent_name'] = $windowData->name;
        $data['talent_address'] = (!empty($address_string)) ? $address_string : '';
        $data['birth_year'] = $windowData->birth_year;
        $data['talent_csinfo'] = $hiddenDao->getCategoriesSubcategories($windowData->_id);
        $data['talent_profile_img'] = $windowData->profile_img;
        $data['talent_achivements'] = $hiddenDao->getAchivements($windowData->achivements);
        $data['talent_awards'] = $hiddenDao->getAwards($windowData->awards);
        $data['talent_education'] = $hiddenDao->getEducation($windowData->education);
        $data['talent_expertice'] = $hiddenDao->getExpertice($windowData->expertice);
        $data['talent_level'] = $hiddenDao->getLevel($windowData->level);
        $data['nbr_views'] = ($statisticDao->getCountViewers($windowData->user) != null) ? $statisticDao->getCountViewers($windowData->user) : 0;
        $data['nbr_followers'] = ($statisticDao->getCountFollowers($windowData->user) != null) ? $statisticDao->getCountFollowers($windowData->user) : 0;
        $data['nbr_connections'] = ($statisticDao->getCountConextions($windowData->user) != null) ? $statisticDao->getCountConextions($windowData->user) : 0;
        $data['nbr_following'] = ($statisticDao->getCountFollowing($windowData->user) != null) ? $statisticDao->getCountFollowing($windowData->user) : 0;
        $data['usr_type'] = session('user')->user_type;
        $data['are_we_connected'] = !empty($hiddenDao->getStatusIfConnected($hiddenDao->getUserByEmailNew()->_id, $windowData->user)) 
            ? $hiddenDao->getStatusIfConnected($hiddenDao->getUserByEmailNew()->_id, $windowData->user) : '';
        $data['video_list'] = $hiddenDao->getUserVideoCatalogId($windowData->_id);
		$videoDetails = [];
		foreach($data['video_list'] as $video) {
			array_push($videoDetails, $hiddenDao->getVideoDetails($video));
        }
        $data['video_list_details'] = $videoDetails;
		return view('public.talent_profile')->with('data',$data);
    }

    public function redirectRouteViewProfile(Request $request, $id) {
        $hiddenDao = new Data;
        $urlCode = $this->getReplaceUrlLongString();
        if(!($hiddenDao->checkExistReplaceUrlHidden($urlCode)==0)) {
            if($hiddenDao->storeReplaceUrlHidden($urlCode, $id)!==1) {
                return '/view-talent-profile?qMby='.$urlCode;
            }
        }
    }

    public function saveNewFollow(Request $request) {

    }

    public function createNewConnection(Request $request) {
        $hiddenDao = new Data;
        $userDao = new Data2;
        $requested = $request->input('right');
        $maskId = $hiddenDao->checkExistReplaceUrlHidden($requested);
        $userRigth = $hiddenDao->getUserDetails($maskId->url)->user;
        $userLeft = $userDao->getMyUserId();
        return json_encode(array('status' => $userDao->addUsersConnection($userLeft, $userRigth)->status));
    }

    protected function getReplaceUrlLongString() {
            $n=450; 
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
            $randomString = ''; 
          
            for ($i = 0; $i < $n; $i++) { 
                $index = rand(0, strlen($characters) - 1); 
                $randomString .= $characters[$index]; 
            } 
          
            return $randomString;
    }
}
