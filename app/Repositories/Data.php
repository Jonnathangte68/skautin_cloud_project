<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Data 
{
    protected $client;

    private function checkIfAlreadyAdded($list, $id) {
        foreach($list as $l) {
            if($l->_id == $id) {
                return 1;
            }
        }
        return 0;
    }

    public function __construct() {
        $this->client = new Client();
    }
    public function getTalentByUserId($user_id) {
        $response = $this->client->get(env('API_URL').'getTalentByUserId?user='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getRecruiterByUserId($user_id) {
        $response = $this->client->get(env('API_URL').'getRecruiterByUserId?user='.$user_id,
            array('form_params' => array('user' => $user_id,'token' => session('user')->token))
        );
        $resp = json_decode($response->getBody()->getContents());
        return $resp;        
    }
    public function getUserByEmail() {
        $user_r = $this->client->get(env('API_URL').'userByEmail',array('form_params' => array('email' => session('user')->email,'token' => session('user')->token))
        );
        $user = json_decode($user_r->getBody()->getContents());
        return $user;
    }
    public function getUserByEmailThisEmail($email) {
        $user_r = $this->client->get(env('API_URL').'userByEmail?email='.$email,
            array('form_params' => array('email' => $email)));
        $user = json_decode($user_r->getBody()->getContents());
        return $user;
    }
    public function getUserByEmailNew() {
        $user_r = $this->client->get(
            env('API_URL').'userByEmail?email='.session('user')->email,
                array(
                    'form_params' => array(
                        'email' => session('user')->email,
                        'token' => session('user')->token)
                )
        );
        return json_decode($user_r->getBody()->getContents());
    }
    public function getCategories() {
        $response = $this->client->get(env('API_URL').'getCategories');
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getSubCategories() {
        $response = $this->client->get(env('API_URL').'getSubCategories');
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getSubCategoriesByCategoryKey(String $key){
        $response = $this->client->get(env('API_URL').'getCategories',
            array('form_params' => array('category_id' => $key))
        );
        $resp = json_decode($response->getBody()->getContents());
        dd($resp);
        return 'n';
    }
    public function getLevels() {
        $response = $this->client->get(env('API_URL').'getLevels');
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getCountries() {
        $response = $this->client->get(env('API_URL').'getCountries');
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getStates() {
        $response = $this->client->get(env('API_URL').'getStates');
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getCities() {
        $response = $this->client->get(env('API_URL').'getCities');
        $resp = json_decode($response->getBody()->getContents());
        return $resp;
    }
    public function getSubsXcategory($categ) {
        $response = $this->client->get(env('API_URL').'getSubsXcategory',
            array('form_params' => array('category_id' => $categ))
        );
        return json_decode($response->getBody()->getContents());
    }
    public function getCategoryOnly($categ) {
        $response = $this->client->get(env('API_URL').'categorys/'.$categ,
            array('form_params' => array('token' => session('user')->token))
        );
        return json_decode($response->getBody()->getContents());
    }
    public function getSubCategoryOnly($scateg) {
        $response = $this->client->get(env('API_URL').'subcategorys/'.$scateg,
            array('form_params' => array('token' => session('user')->token))
        );
        return json_decode($response->getBody()->getContents());
    }
    public function getInterest($interest_id) {
        $info = $this->client->get(env('API_URL').'interests/'.$interest_id.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }
    public function getVacantJobType($vacant_id) {
        $response = $this->client->get(env('API_URL').'jobs/'.$vacant_id,
            array('form_params' => array('token' => session('user')->token))
        );
        $v = json_decode($response->getBody()->getContents());
        if(property_exists($v, 'job_type')) {
        $r = $this->client->get(env('API_URL').'jobtypes/'.$v->job_type,
            array('form_params' => array('token' => session('user')->token))
        );
        return json_decode($r->getBody()->getContents());
        }else {
            return null;
        }
    }
    public function getVacantLevel($vacant_id) {
        $response = $this->client->get(env('API_URL').'jobs/'.$vacant_id,
            array('form_params' => array('token' => session('user')->token))
        );
        $v = json_decode($response->getBody()->getContents());
        if(property_exists($v, 'level')) {
        $r = $this->client->get(env('API_URL').'levels/'.$v->level,
            array('form_params' => array('token' => session('user')->token))
        );
        return json_decode($r->getBody()->getContents());
        }else {
            return null;
        }
    }
    public function getUserDetails($id) {
        $res = $this->client->get(env('API_URL').'talents/'.$id."?token=".session('user')->token,array('form_params' => array()));
        if ($res){
            return json_decode($res->getBody()->getContents());
        }
        $res = $this->client->get(env('API_URL').'recruiters/'.$id."/?token=".session('user')->token,array('form_params' => array()));
        if ($res) {
            return json_decode($res->getBody()->getContents());
        }
    }
    public function getCategoriesSubcategories($id) {
        $res = $this->client->get(env('API_URL').'talents/'.$id."?token=".session('user')->token,array('form_params' => array()));
        $vData = json_decode($res->getBody()->getContents());
        if (!empty($vData)){
            $reqInfo = array('categories' => array(),'subcategories' => array());
            foreach($vData->category as $category_id) {
                array_push($reqInfo['categories'], $this->getCategoryOnly($category_id)->name);
            }
            foreach($vData->subcategory as $subcategory_id) {
                array_push($reqInfo['subcategories'], $this->getSubCategoryOnly($subcategory_id)->name);
            }
            shuffle($reqInfo['categories']);
            shuffle($reqInfo['subcategories']);
            $output = "";
            foreach($reqInfo['categories'] as $r) {
                if($output!="")
                    $output .= ", ";
                $output .= $r;
            }
            foreach($reqInfo['subcategories'] as $r) {
                if($output!="")
                    $output .= ", ";
                $output .= $r;
            }
            return $output;
        }
        $res = $this->client->get(env('API_URL').'recruiters/'.$id."/?token=".session('user')->token,array('form_params' => array()));
        $vData = json_decode($res->getBody()->getContents());
        if (!empty($vData)){
            $reqInfo = array('categories' => array(),'subcategories' => array());
            foreach($vData->interest_list as $interst) {
                if($this->getInterest($interst)->name === "Categoria") {
                    array_push($reqInfo['categories'], $this->getCategoryOnly($this->getInterest($interst)->value)->name);
                }
                if($this->getInterest($interst)->name === "Subcategoria") {
                    array_push($reqInfo['subcategories'], $this->getSubCategoryOnly($this->getInterest($interst)->value)->name);
                }
            }
            shuffle($reqInfo['categories']);
            shuffle($reqInfo['subcategories']);
            $output = "";
            foreach($reqInfo['categories'] as $r) {
                if($output!="")
                    $output .= ", ";
                $output .= $r;
            }
            foreach($reqInfo['subcategories'] as $r) {
                if($output!="")
                    $output .= ", ";
                $output .= $r;
            }
            return $output;
        }
    }
    public function getUserDetails2($id) {
        $res = $this->client->get(env('API_URL').'searchTalentByUid?uid='.$id."&token=".session('user')->token,array('form_params' => array()));
        if ($res){
            return json_decode($res->getBody()->getContents());
        }
        $res = $this->client->get(env('API_URL').'searchRecruiterByUid?uid='.$id."&?token=".session('user')->token,array('form_params' => array()));
        if ($res) {
            return json_decode($res->getBody()->getContents());
        }
    }
    public function getTalents() {
$talents_all = $this->client->get(env('API_URL').'talents/',array('form_params' => array('token' => session('user')->token)));
        $talents = json_decode($talents_all->getBody()->getContents());
        return $talents;
    }
    public function getRecruiters() {
$recruiters_all = $this->client->get(env('API_URL').'recruiters/',array('form_params' => array('token' => session('user')->token)));
        $recruiters = json_decode($recruiters_all->getBody()->getContents());
        return $recruiters;
    }

    public function getByUserIdAnything($id) {
        $info = $this->client->get(env('API_URL').'get_rec_tal_by_usr_id?id='.$id,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }

    public function addressGetter($address_id) {
        $info = $this->client->get(env('API_URL').'address/'.$address_id.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }

    public function getConnectionsPending() {
        $connections_all_r = $this->client->get(env('API_URL').'pending_connection_f_user?token='.session('user')->token.'&usr_email='.session('user')->email,
            array('form_params' => array('token' => session('user')->token))
        );
        return json_decode($connections_all_r->getBody()->getContents());
    }

    public function getConnections2() {
        $abc = array();
        $connections_all_r = $this->client->get(env('API_URL').'connection_f_user?token='.session('user')->token.'&usr_email='.session('user')->email,
            array('form_params' => array('token' => session('user')->token))
        );
        foreach (json_decode($connections_all_r->getBody()->getContents())->message as $connection) {
            $user_email = '';
            if ($connection->leftside_user==session('user')->email) {
                $user_email = $connection->rightside_user;
            }else {
                $user_email = $connection->leftside_user;
            }
            $d = $this->client->get(env('API_URL').'get_user_info_by_id?email='.$user_email,
                array('form_params' => array('token' => session('user')->token))
            ); 
            array_push($abc, json_decode($d->getBody()->getContents()));
        }
        return $abc;
    }

    public function getConnections3() {
        $connections_all_r = $this->client->get(env('API_URL').'connection_f_user?token='.session('user')->token.'&usr_email='.session('user')->email,
            array('form_params' => array('token' => session('user')->token))
        );
        return json_decode($connections_all_r->getBody()->getContents());
    }

    public function getSuggestions() {
        // Return value
        $lresult = array();
        /* init section */
        $filter_categories = array();
        $ignore = array();
        foreach ($this->getConnections3()->message as $tmpctc) {
            array_push($ignore, $tmpctc->_id);
        }
        if (session('user')->user_type=="t") {
            $dets = $this->client->get(env('API_URL').'get_talent_by_user_email?email='.session('user')->email,array('form_params' => array('token' => session('user')->token)));
            $dets = json_decode($dets->getBody()->getContents());
            $filter_categories = array_merge($dets->subcategory, $dets->category);
        }   else {
            $dets = $this->client->get(env('API_URL').'get_recruiter_by_user_email?email='.session('user')->email,array('form_params' => array('token' => session('user')->token)));
            $dets = json_decode($dets->getBody()->getContents());
            $datsl = $this->client->get(env('API_URL').'list_interest_loader?rec='.$dets->_id, array('form_params' => array('token' => session('user')->token)));
            $datsl = json_decode($datsl->getBody()->getContents());
            $meaningfullArr = $datsl->s;
            foreach($meaningfullArr as $itemL) {
                if($itemL->name == 'Categoria' || $itemL->name == 'Subcategoria') {
                    array_push($filter_categories, $itemL->value);
                }
            }
        }
        $recs = $this->client->get(env('API_URL').'recruiters/',array('form_params' => array('token' => session('user')->token)));
        $tals = $this->client->get(env('API_URL').'talents/',array('form_params' => array('token' => session('user')->token)));
        $arr = json_decode($tals->getBody()->getContents());
        $full_list = array_merge($arr, json_decode($recs->getBody()->getContents()));
        shuffle($full_list);
        foreach ($full_list as $tlntrecr) {
            if($this->checkIfAlreadyAdded($lresult, $tlntrecr->_id)!=1) {

                // Is a talent and have same criteria
                if (property_exists($tlntrecr, 'category')) {
                    if (!empty(array_intersect($filter_categories, $tlntrecr->category))) {
                        array_push($lresult, $tlntrecr);
                    }
                }else if (property_exists($tlntrecr, 'subcategory')) {
                    if (!empty(array_intersect($filter_categories, $tlntrecr->subcategory))) {
                        array_push($lresult, $tlntrecr);
                    }
                }
                // Is a recruiter find criteria by his interest list
                if (property_exists($tlntrecr, 'interest_list')) {
                        foreach($tlntrecr->interest_list as $interst) {
                            $interestDetails = $this->getInterest($interst);
                            if($interestDetails->name=="Categoria" || $interestDetails->name=="Subcategoria") {
                                if (!empty(array_intersect($filter_categories, [$interestDetails->value]))) {
                                    array_push($lresult, $tlntrecr);
                                }
                            }
                        }
                }   
            }        
        }
        return $lresult;
    }

    public function checkExistReplaceUrlHidden($code) {
        $info = $this->client->get(env('API_URL').'hiddenroutes/'.$code.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        if(empty($i)) {
            return 1;
        }else {
            return $i;
        }
    }

    public function storeReplaceUrlHidden($mask, $url) {
        $client = new Client();
        $response = $client->post(
            env('API_URL').'hiddenroutes/',
            array(
                'form_params' => array(
                    'mask' => $mask,
                    'url' => $url,
                    'token' => session('token'),
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

    public function getAchivements(array $achivements) {
        $loadedAchivements = array();
        foreach($achivements as $achivement) {
            $info = $this->client->get(env('API_URL').'achivements/'.$achivement.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
            $i = json_decode($info->getBody()->getContents());
            if(!empty($i)) {
                array_push($loadedAchivements, $achivement);
            }
        }
        return $loadedAchivements;
    }
    public function getAwards(array $awards) {
        $loadedAchivements = array();
        foreach($awards as $award) {
            $info = $this->client->get(env('API_URL').'awards/'.$award.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
            $i = json_decode($info->getBody()->getContents());
            if(!empty($i)) {
                array_push($loadedAchivements, $awards);
            }
        }
        return $loadedAchivements;
    }
    public function getEducation(array $educations) {
        $loadedAchivements = array();
        foreach($educations as $education) {
            $info = $this->client->get(env('API_URL').'educations/'.$education.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
            $i = json_decode($info->getBody()->getContents());
            if(!empty($i)) {
                array_push($loadedAchivements, $educations);
            }
        }
        return $loadedAchivements;
    }
    public function getExpertice(array $expertices) {
        $loadedAchivements = array();
        foreach($expertices as $expertice) {
            $info = $this->client->get(env('API_URL').'laborumexpertices/'.$expertice.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
            $i = json_decode($info->getBody()->getContents());
            if(!empty($i)) {
                array_push($loadedAchivements, $expertice);
            }
        }
        return $loadedAchivements;
    }
    public function getLevel($level) {
        $info = $this->client->get(env('API_URL').'levels/'.$level.'?token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }
    public function getUserVideoCatalogId($id) {
        $info = $this->client->get(env('API_URL').'getUserVideoCatalogId?user_id='.$id.
            '&token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i->videos;
    }
    public function getVideoDetails($video) {
        $info = $this->client->get(env('API_URL').'getDetailsVid?vid='.$video.
            '&token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }
    public function getVideoInformation($talent) {
        $info = $this->client->get(env('API_URL').'getFirstVideoFromCatalog?tal='.$talent.
            '&token='.session('user')->token,array('form_params' => array('token' => session('user')->token)));
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }
    public function getStatusIfConnected($user_one, $user_two) {
        $info = $this->client->get(
            env('API_URL').'get_status_if_connected?user_one='.$user_one
            .'&user_two='.$user_two,
            array());
        $i = json_decode($info->getBody()->getContents());
        return $i;
    }
}