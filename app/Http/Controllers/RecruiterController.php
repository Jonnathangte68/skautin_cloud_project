<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Repositories\Enterprise;
// use App\Repositories\Data2;
// use App\Repositories\Data;

// use JavaScript;
// use function GuzzleHttp\json_encode;

class RecruiterController extends Controller
{
    public function vacantmanagement(Request $request) {
    	return view('recruiter.vacant_manag_view')->with('data', []);
    }

//     public function profile() {
//         $data = array();
//         $ep = new Enterprise;
//         $empresa = $ep->getEnterprise();
//         array_push($data, $empresa);
//         return view('recruiter.profile_view')->with('data',$data);
//     }

//     public function conex() {
//         $data = array();
//         $ep = new Enterprise;
//         $empresa = $ep->getEnterprise();
//         array_push($data, $empresa);
//         $dt = new Data;
//         //$conexiones = $dt->getConnections();
//         $conexiones = [];
//         array_push($data, $conexiones);
//         return view('recruiter.conex_view')->with('data',$data);        
//     }

//     public function test_settings($option = null) {
//         $option_number = 0;
//         switch ($option) {
//             case 'invite-fb':
//                 $option_number = 1;
//                 break;
//             case 'global-settings':
//                 $option_number = 2;
//                 break;
//             case 'account-management':
//                 $option_number = 3;
//                 break;
//             case 'help':
//                 $option_number = 4;
//                 break;
//             case 'log-out':
//                 $option_number = 5;
//                 break;
//         }
//         //JavaScript::put(['opcion' => $option_number]);
//         //dd($option);
//         $data = array();
//         $ep = new Enterprise;
//         array_push($data, $ep->getEnterprise());
//         array_push($data, $option_number);
//         //array_push($data, $option_number);
//         return view('recruiter.settings_account')->with('data',$data);
//     }

//     public function accountEdit() {
//         $ep = new Enterprise;
// 		$dt = new Data;
// 		$uid = $dt->getUserByEmailNew()->_id;
// 		$data = array(
// 			0 => $ep->getEnterprise(),
// 			'ctgs'  => $dt->getCategories(),
//             'sub_ctgs'   => $dt->getSubCategories(),
//             'levels' => $dt->getLevels(),
//             'countries' => $dt->getCountries(),
//             'states' => $dt->getStates(),
//             'cities' => $dt->getCities(),
//             'userdata' => $dt->getByUserIdAnything($uid),
//             'address' => (property_exists($dt->getByUserIdAnything($uid), 'address')) ? $dt->addressGetter($dt->getByUserIdAnything($uid)->address) : NULL
// 		);
// 		return view('recruiter.language_settings')->with('data',$data);
//     }
    
//     public function advancedSearch() {
// 		$data = array();
// 		$ep = new Enterprise;
//     	$empresa = $ep->getEnterprise();
//     	array_push($data, $empresa);
// 		return view('recruiter.advanced_search')->with('data',$data);
//     }
    
//     public function settingsAccount($option = null) {
// 	    $datax = new Data;
// 		$option_number = 0;
// 		switch ($option) {
// 			case 'invite-fb':
// 				$option_number = 1;
// 				break;
// 			case 'global-settings':
// 				$option_number = 2;
// 				break;
// 			case 'account-management':
// 				$option_number = 3;
// 				break;
// 			case 'help':
// 				$option_number = 4;
// 				break;
// 			case 'log-out':
// 				$option_number = 5;
// 				break;
// 		}
// 		JavaScript::put(['opcion' => $option_number]);
// 		//dd($option);
// 		$data = array();
// 		$ep = new Enterprise;
//     	array_push($data, $ep->getEnterprise());
//     	array_push($data, $option_number);
//     	/* Check if user already has a token for facebook */
//         $logedInUser = $datax->getUserByEmailNew();
//         $facebook_token = 0;
//         if (property_exists($logedInUser, 'fbAuthToken') && !empty($logedInUser->fbAuthToken))
//             $facebook_token = 1;
//         $data['facebook_token'] = $facebook_token;
// 		return view('recruiter.settings_account')->with('data',$data);
// 	}

//     public function simpleSearch(Request $request) {
//         $data = array();
//         $ep = new Enterprise;
//         array_push($data, $ep->getEnterprise());
//         array_push($data, $request->search_terms);
//         return view('recruiter.search_results')->with('data',$data);
//     }

//     public function getRightData(Request $request) {
//         $data = array();
//     	$dt = new Data;
//     	$conexionespending = $dt->getConnectionsPending();
//         $suggestions = $dt->getSuggestions();   
//     	array_push($data, $conexionespending);
//     	array_push($data, $suggestions);
//     	return json_encode($data);
//     }

//     public function getConnectionsUsersData(Request $request) {
//         $dt = new Data;
//         //dd($dt->getCategoriesSubcategories($request->input('tId')));
//         return $dt->getCategoriesSubcategories($request->input('tId'));
//     }

//     /*
//         *   Funcion que se encarga de buscar resultados para una busqueda simple en base a 
//         *   un criterio de ese objeto recibe 3 parametros por la req, 1 - El termino o coincidencia a buscar 
//         *   ,2 - (pass_values) El arreglo que contiene coincidencias previas con los terminos buscados, 3 - El 
//         *   tipo de busqueda se es de un talento, reclutador o vacante.
//     */
//     public function rquerySearch(Request $request) {
//         $val1 = $request->terms;
//         $val2 = $request->pass_values; // Se carga con los _ids propios 
//         $qtype = $request->qtype;
//         $r = array();
//         $dt = new Data;
//         //dd($qtype);
//         $perc = 80.20;

//         if ($qtype=='talent_search') {
//             if ($val2) {
//                 foreach ($dt->getTalents() as $v) {
//                     if (!in_array($v->_id, $val2)) {
//                         if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
//                             array_push($r, $v);
//                             array_push($val2, $v->_id);
//                         }
//                     }
//                 }
//             }else {
//                 $val2 = array();
//                 foreach ($dt->getTalents() as $v) {
//                     if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
//                         array_push($r, $v);
//                         array_push($val2, $v->_id);
//                     }
//                 }
//             }
//             shuffle($r);
//             return json_encode(array('results' => $r, 'pass_values' => $val2));         
//         }else if($qtype=='recruiter_search') {
//             if ($val2) {
//                 foreach ($dt->getRecruiters() as $v) {
//                     if (!in_array($v->_id, $val2)) {
//                         if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
//                             array_push($r, $v);
//                             array_push($val2, $v->_id);
//                         }
//                     }
//                 }
//             }else {
//                 $val2 = array();
//                 foreach ($dt->getRecruiters() as $v) {
//                     if(similar_text($v->name,$val1,$perc) >= strlen($val1)) {
//                         array_push($r, $v);
//                         array_push($val2, $v->_id);
//                     }
//                 }
//             }
//             shuffle($r);
//             return json_encode(array('results' => $r, 'pass_values' => $val2));
//         }else if($qtype=='job_search') {
// // N.I
//             return json_encode(array('results' => array(), 'pass_values' => array()));
//         }else {
//             return json_encode(array('results' => array(), 'pass_values' => array()));
//         }
//     }
}
