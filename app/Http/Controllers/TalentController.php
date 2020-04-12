<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Enterprise;

use App\Repositories\Data;

use App\Repositories\User;

use App\Repositories\Vacant;

use App\Repositories\Video;

use App\Repositories\Talent;

use App\Repositories\Country;

use App\Repositories\State;

use App\Repositories\City;

use App\Repositories\Statistic;

use Carbon\Carbon;

use Facebook\Facebook;

use JavaScript;


class TalentController extends Controller
{
	public function __construct() {
		// Declarar Objetos importante
		// Verficar permisos
	}

	// Mostrar ventana de busqueda avanzada
	public function advancedSearch() {
		$data = array();
		$ep = new Enterprise;
    	$empresa = $ep->getEnterprise();
    	array_push($data, $empresa);
		return view('talent.advanced_search')->with('data',$data);
	}

	// Mostrar ventana de descripcion de la vacante
	public function vacantDescription($id) {
		$data = array();
		$ep = new Enterprise;
    	$empresa = $ep->getEnterprise();
    	array_push($data, $empresa);
		$vacant = new Vacant;
		array_push($data,$vacant->getVacantOne($id));
		$dta = new Data;
		if (property_exists($vacant->getVacantOne($id),'category')) {
			$catg = $dta->getCategoryOnly($vacant->getVacantOne($id)->category);
			array_push($data, $catg);
		}else {
			array_push($data, json_decode('{"name": "nodata"}'));
		}
		if (property_exists($vacant->getVacantOne($id),'subcategory')) {
			$s_catg = $dta->getSubCategoryOnly($vacant->getVacantOne($id)->subcategory);
			array_push($data, $s_catg);
		}else {
			array_push($data, json_decode('{"name": "nodata"}'));
		}
		$jobtype = $dta->getVacantJobType($vacant->getVacantOne($id)->_id);
		array_push($data, $jobtype);
		$lvl = $dta->getVacantLevel($vacant->getVacantOne($id)->_id);
		array_push($data, $lvl);
		$cty = new City();
		$reg_data = $cty->getRegionalData($id);

		$talent = new Talent();
		JavaScript::put([
			'talent_id'=>$talent->getId()
		]);

		return view('talent.descripcion_vacante')->with(['data'=>$data, 'third_data'=> $vacant->getVacantOne($id), 'region'=> $reg_data]);
	}

	// Mostrar ventana de descripcion de la vacante
	public function showProfile() {
		$data = array();
		$ep = new Enterprise;


		$video = new Video;
		$vc = $video->getVCatalog();
		//dd($vc[0]->videos);

		$vall = array();
		foreach ($vc[0]->videos as $v) {
		 	//dd($video->getVideoById($v));
		 	array_push($vall, $video->getVideoById($v));
		}
    	array_push($data, $ep->getEnterprise());
    	array_push($data, $vall);
		return view('talent.profile')->with('data',$data);
	}

	// Mostrar ventana de descripcion de la vacante
	public function showConnections() {
		//dd(session('user')->token);
		$data = array();
		$ep = new Enterprise;
    	array_push($data, $ep->getEnterprise());
    	$dt = new Data;
    	$conexiones = $dt->getConnections2();
    	array_push($data, $conexiones);
		return view('talent.connections')->with('data',$data);
	}

	public function showPConnectionsAndSuggested() {
		$data = array();
    	$dt = new Data;
    	$conexionespending = $dt->getConnectionsPending();
		$suggestions = $dt->getSuggestions();
		array_push($data, $conexionespending);
		$findIndex = -1;
		for($i = 0 ; $i < count($suggestions) ; $i++) {
			if($suggestions[$i]->user == $dt->getUserByEmailNew()->_id) {
				$findIndex = $i;
				break;
			}
		}
		if($findIndex!=-1) {
			unset($suggestions[$findIndex]);
		}
		array_push($data, array_values($suggestions));
    	return json_encode($data);
	}

	public function uploadVideo() {
		return view('talent.video_upload');
	}

	public function simpleSearch(Request $request) {
		$data = array();
		$ep = new Enterprise;
		array_push($data, $ep->getEnterprise());
		array_push($data, $request->search_terms);
		return view('talent.search_results')->with('data',$data);
	}

	public function settingsAccount($option = null) {
	    $datax = new Data;
		$option_number = 0;
		switch ($option) {
			case 'invite-fb':
				$option_number = 1;
				break;
			case 'global-settings':
				$option_number = 2;
				break;
			case 'account-management':
				$option_number = 3;
				break;
			case 'help':
				$option_number = 4;
				break;
			case 'log-out':
				$option_number = 5;
				break;
		}
		JavaScript::put(['opcion' => $option_number]);
		$data = array();
		$ep = new Enterprise;
    	array_push($data, $ep->getEnterprise());
    	array_push($data, $option_number);
        $logedInUser = $datax->getUserByEmailNew();
        $facebook_token = 0;
        if (property_exists($logedInUser, 'fbAuthToken') && !empty($logedInUser->fbAuthToken))
            $facebook_token = 1;
        $data['facebook_token'] = $facebook_token;
		return view('talent.settings_account')->with('data',$data);
	}

	public function removeConnection($id) {
		dd('Nada aun');
	}


	/*
	*	Funcion que se encarga de buscar resultados para una busqueda simple en base a 
	*	un criterio de ese objeto recibe 3 parametros por la req, 1 - El termino o coincidencia a buscar 
	*	,2 - (pass_values) El arreglo que contiene coincidencias previas con los terminos buscados, 3 - El 
	*	tipo de busqueda se es de un talento, reclutador o vacante.
	*/
	public function tquerySearch(Request $request) {
		$val1 = $request->terms;
		$val2 = $request->pass_values; // Se carga con los _ids propios 
		$qtype = $request->qtype;
		$r = array();
		$dt = new Data;
		//dd($qtype);
		$perc = 80.20;

		if ($qtype=='talent_search') {
			if ($val2) {
				foreach ($dt->getTalents() as $v) {
					if (!in_array($v->_id, $val2)) {
						if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
							array_push($r, $v);
							array_push($val2, $v->_id);
						}
					}
				}
			}else {
				$val2 = array();
				foreach ($dt->getTalents() as $v) {
					if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
						array_push($r, $v);
						array_push($val2, $v->_id);
					}
				}
			}
			shuffle($r);
			return json_encode(array('results' => $r, 'pass_values' => $val2));			
		}else if($qtype=='recruiter_search') {
			if ($val2) {
				foreach ($dt->getRecruiters() as $v) {
					if (!in_array($v->_id, $val2)) {
						if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
							array_push($r, $v);
							array_push($val2, $v->_id);
						}
					}
				}
			}else {
				$val2 = array();
				foreach ($dt->getRecruiters() as $v) {
					if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
						array_push($r, $v);
						array_push($val2, $v->_id);
					}
				}
			}
			shuffle($r);
			return json_encode(array('results' => $r, 'pass_values' => $val2));
		}else if($qtype=='job_search') {
// N.I
			return json_encode(array('results' => array(), 'pass_values' => array()));
		}else {
			return json_encode(array('results' => array(), 'pass_values' => array()));
		}
	}

	public function accountEdit() {
		$ep = new Enterprise;
		$dt = new Data;
		$uid = $dt->getUserByEmailNew()->_id;
		$data = array(
			0 => $ep->getEnterprise(),
			'ctgs'  => $dt->getCategories(),
            'sub_ctgs'   => $dt->getSubCategories(),
            'levels' => $dt->getLevels(),
            'countries' => $dt->getCountries(),
            'states' => $dt->getStates(),
            'cities' => $dt->getCities(),
            'userdata' => $dt->getByUserIdAnything($uid),
            'address' => $dt->addressGetter($dt->getByUserIdAnything($uid)->address)
		);
		return view('talent.language_settings')->with('data',$data);
	}

	public function loadjobsextra(Request $request) {
		$v = new Vacant();
		return json_encode($v->extraLoad($request->input('jid')));
	}

	public function editTalent(Request $request) {
        $dta = new Talent;
        return $dta->edit($request->input('_id'), $request->input('country'),
            $request->input('state'), $request->input('city')
            , $request->input('name'), $request->input('gender')
                , $request->input('yearofbirth'), $request->input('level'));
    }

	public function applyVacant(Request $request) {
		$job_id = $request->input('job_id');
		$talent_id = $request->input('talent_id');
		$vacant = new Vacant;
		$result = $vacant->apply($job_id, $talent_id);
		return $result;
	}

	public function getFbFriends(Request $request) {
	    return json_encode(array('status' => 0, 'friend_list' => array(), 'fb_login_url' => $loginUrl));
    }

    public function changeUpdateImage(Request $request) {
        $dta = new Talent;
        return $dta->updateImage($request->file('image'));
    }

    public function changeUpdatePass(Request $request) {
	    // usr, p, pass
        $dta = new Talent;
        return json_encode($dta->updateUserPass(session('user')->email, $request->input('oldPass'),$request->input('newPass')));
    }

    public function getStatusNotifications() {
	    $datax = new Data;
	    return json_encode($datax->getUserByEmail(session('user')->email));
    }

    public function showFbLoginPage(Request $request) {
        return view('talent.fb_login_page');
	}
	
	public function editViewMyProfile(Request $request) {
		$data = array();
		$ep = new Enterprise;
		$dataDao = new Data;
		$statisticDao = new Statistic;
		$data[0] = $ep->getEnterprise();
		$currentId = $dataDao->getUserByEmail()->_id;
		$usrDetails = $dataDao->getTalentByUserId($dataDao->getUserByEmail()->_id);
		$addr = $dataDao->addressGetter($usrDetails->address);
		if(!empty($addr)) {
            $address_string = "";
            $countryDao = new Country;
            $stateDao = new State;
            $cityDao = new City;
            if($addr->country != null && !empty($countryDao->getCountryOne($addr->country))) {
                $address_string .= $countryDao->getCountryOne($addr->country)->name;
            }
            if($addr->state != null && !empty($stateDao->getStateOne($addr->state))) {
                $address_string .= ", ".$stateDao->getStateOne($addr->state)->name;
            }
            if($addr->city != null && !empty($cityDao->getCityOne($addr->city))) {
                $address_string .= ", ".$cityDao->getCityOne($addr->city)->name;
            }
        }
		$data['talent_id'] = $usrDetails->_id;
        $data['talent_name'] = $usrDetails->name;
		$data['talent_address'] = (!empty($address_string)) ? $address_string : '';
        $data['birth_year'] = $usrDetails->birth_year;
        $data['talent_csinfo'] = $dataDao->getCategoriesSubcategories($usrDetails->_id);
        $data['talent_profile_img'] = $usrDetails->profile_img;
        $data['talent_achivements'] = $dataDao->getAchivements($usrDetails->achivements);
        $data['talent_awards'] = $dataDao->getAwards($usrDetails->awards);
        $data['talent_education'] = $dataDao->getEducation($usrDetails->education);
        $data['talent_expertice'] = $dataDao->getExpertice($usrDetails->expertice);
        $data['talent_level'] = $dataDao->getLevel($usrDetails->level);
		$data['user_data'] = $usrDetails;
		$data['nbr_views'] = ($statisticDao->getCountViewers($currentId) != null) ? $statisticDao->getCountViewers($currentId) : 0;
        $data['nbr_followers'] = ($statisticDao->getCountFollowers($currentId) != null) ? $statisticDao->getCountFollowers($currentId) : 0;
        $data['nbr_connections'] = ($statisticDao->getCountConextions($currentId) != null) ? $statisticDao->getCountConextions($currentId) : 0;
		$data['nbr_following'] = ($statisticDao->getCountFollowing($currentId) != null) ? $statisticDao->getCountFollowing($currentId) : 0;
		$data['video_list'] = $dataDao->getUserVideoCatalogId($usrDetails->_id);
		$videoDetails = [];
		foreach($data['video_list'] as $video) {
			array_push($videoDetails, $dataDao->getVideoDetails($video));
		}
		$data['video_list_details'] = $videoDetails;
		return view('talent.profile')->with('data', $data);
	}

    public function changeUserStatus() {
	    $userDao = new User;
	    $datay = new Data;
        $logedInUser = $datay->getUserByEmailNew();
        $id = $logedInUser->_id;
	    if ($userDao->changePrivateStatus($id)===0) {
	        return json_encode(true);
        }else {
            return json_encode(false);
        }
    }

    public function deleteUser() {
        $userDao = new User;
        $datay = new Data;
        $logedInUser = $datay->getUserByEmailNew();
        $id = $logedInUser->_id;
        if ($userDao->changeStatus($id)===0) {
            return json_encode(true);
        }else {
            return json_encode(false);
        }
	}
	
	public function getVideoInfo(Request $request) {
		$data = new Data;
		$videoInfo = $data->getVideoInformation($request->input('talent'));
		return json_encode($videoInfo);
	}
}
