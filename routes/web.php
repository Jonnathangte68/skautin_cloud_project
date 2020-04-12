<?php

use App\Http\Middleware\CheckAuthentication;
use App\Http\Middleware\CheckEntrance;
use App\Http\Middleware\RedirectAlreadyMet;
use App\Http\Middleware\RedirectIfAuthenticated;

use App\Repositories\Pagina;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PublicoController@authenticateGuest')->middleware(RedirectAlreadyMet::class);
Route::get('/skauting-access/{tok}', 'PublicoController@validateToken');
Route::get('/landing', 'PublicoController@welcome')->middleware([CheckEntrance::class, RedirectIfAuthenticated::class]);
Route::get('/new-talent-registration', 'HomeController@showNewTalentReg')->middleware([CheckEntrance::class, RedirectIfAuthenticated::class]);
Route::get('/new-recruiter-registration', 'HomeController@showNewRecruiterReg')->middleware([CheckEntrance::class, RedirectIfAuthenticated::class]);
Route::get('/home-prospects', 'DashboardController@homeRecruiter')->middleware([CheckEntrance::class, CheckAuthentication::class]);
Route::get('log-out','HomeController@logOut')->name('logOut')->middleware([CheckEntrance::class, CheckAuthentication::class]);
Route::get('/home-oportunities', 'DashboardController@homeTalent')->name('hoportunities');
Route::get('/talent-preview/{id}','HomeController@showPreviewTalentProfile')->middleware([CheckEntrance::class, CheckAuthentication::class]);
Route::get('/jobs','HomeController@showRecruiterJobs')->middleware([CheckEntrance::class, CheckAuthentication::class])->name('jobs');

Route::post('/validate', 'PublicoController@validateEntrance');
Route::post('/home', 'HomeController@iniciarSesion');



// R

Route::get('/manage-vacants','RecruiterController@vacantmanagement')->name('vacant_management');

Route::get('/checkUserAuthL', 'PublicoController@checkTk');

Route::get('/ajaxcountries', 'HomeController@getCountriesAjax');
Route::get('/ajaxstates', 'HomeController@getStatesAjax');
Route::get('/ajaxcities', 'HomeController@getCitiesAjax');

Route::get('/about', function () {
    $ep = new Pagina;
    $page = $ep->findOneByName("about");
    $css_file_path = "css/generated/custom-styles_".mt_rand(2, 1000000000000000).".css";
    $full_css_file_path = "../public/".$css_file_path;
    if (property_exists($page, "css")) {file_put_contents($full_css_file_path, $page->css);} else {file_put_contents($full_css_file_path, "/* No styles */");}
    $page_info = array("html"=>$page->html, "css_file"=> $css_file_path);
    return view('about', $page_info);
});

Route::get('/contact', function () {
    $ep = new Pagina;
    $page = $ep->findOneByName("contact");
    $css_file_path = "css/generated/custom-styles_".mt_rand(2, 1000000000000000).".css";
    $full_css_file_path = "../public/".$css_file_path;
    if (property_exists($page, "css")) {file_put_contents($full_css_file_path, $page->css);} else {file_put_contents($full_css_file_path, "/* No styles */");}
    $page_info = array("html"=>$page->html, "css_file"=> $css_file_path);
    return view('contact', $page_info);
});

Route::get('/language', function () {
    $ep = new Pagina;
    $page = $ep->findOneByName("lang");
    $css_file_path = "css/generated/custom-styles_".mt_rand(2, 1000000000000000).".css";
    $full_css_file_path = "../public/".$css_file_path;
    if (property_exists($page, "css")) {file_put_contents($full_css_file_path, $page->css);} else {file_put_contents($full_css_file_path, "/* No styles */");}
    $page_info = array("html"=>$page->html, "css_file"=> $css_file_path);
    return view('language', $page_info);
});

Route::get('/terms', function () {
    /*Original*/
    /*$ep = new Pagina;
    $page = $ep->findOneByName("terms");
    $css_file_path = "css/generated/custom-styles_".mt_rand(2, 1000000000000000).".css";
    $full_css_file_path = "../public/".$css_file_path;*/
    //if (property_exists($page, "css")) {file_put_contents($full_css_file_path, $page->css);} else {file_put_contents($full_css_file_path, "/* No styles */");}
    //$page_info = array("html"=>$page->html, "css_file"=> $css_file_path);
    //return view('terms', $page_info);
    $ep = new Pagina;
    $page = $ep->findOneByName("landing");
    $css_file_path = "css/generated/custom-styles_".mt_rand(2, 1000000000000000).".css";
    $full_css_file_path = "../public/".$css_file_path;
    if (property_exists($page, "css")) {file_put_contents($full_css_file_path, $page->css);} else {file_put_contents($full_css_file_path, "/* No styles */");}
    $page_info = array("html"=>$page->html, "css_file"=> $css_file_path);
    return view('terms', $page_info);
});

// Route::post('/home', 'HomeController@iniciarSesion')->middleware('check.auth');
Route::post('/registration', 'HomeController@registerUser');

Route::get('/getcategsxsubcategs/{categoria}', 'HomeController@getSubsXCateg');

/* Rutas del Talento */

Route::get('/advance-search', 'TalentController@advancedSearch')->name('busqueda_avanzada_talento')->middleware('cauth');
Route::get('/vacant-details/{id}', 'TalentController@vacantDescription')->name('details_vacant_talento')->middleware('cauth');
Route::get('/profile', 'TalentController@showProfile')->name('profile_talento')->middleware('cauth');
Route::get('/relations', 'TalentController@showConnections')->name('relations_talento')->middleware('cauth');
Route::get('/settings', 'TalentController@showConfiguration')->name('conf_talento')->middleware('cauth');
Route::get('/video-uploading', 'TalentController@uploadVideo')->name('video_uploading')->middleware('cauth');
Route::get('/search', 'TalentController@simpleSearch')->name('simple_search')->middleware('cauth');
Route::get('/account-settings/{option?}', 'TalentController@settingsAccount')->name('account_settings')->middleware('cauth');
Route::get('/remove-connection/{id}', 'TalentoController@removeConnection')->name('remove_connection')->middleware('cauth');

/* -- Rutas de la configuracion del Talento -- */
Route::get('/edit-account', 'TalentController@accountEdit')->name('talent_account_edit')->middleware('cauth');

/* Rutas del Reclutador */

Route::get('/advance-searches', 'RecruiterController@advancedSearch')->name('busqueda_avanzada_recruiter')->middleware('rauth');
//Route::get('/profile', 'TalentController@showProfile')->name('profile_recruiter')->middleware('cauth');
//Route::get('/relations', 'TalentController@showConnections')->name('relations_talento')->middleware('cauth');
//Route::get('/configuration-settings', 'RecruiterController@showConfiguration')->name('conf_talento')->middleware('cauth');
//Route::get('/video-uploading', 'TalentController@uploadVideo')->name('video_uploading')->middleware('cauth');
//Route::get('/search', 'TalentController@simpleSearch')->name('simple_search')->middleware('cauth');
Route::get('/account-configuration-settings/{option?}', 'RecruiterController@settingsAccount')->name('rec_account_settings')->middleware('rauth');
//Route::get('/remove-connection/{id}', 'TalentoController@removeConnection')->name('remove_connection')->middleware('cauth');

/* -- Rutas de la configuracion del Talento -- */
Route::get('/edit-user-account', 'RecruiterController@accountEdit')->name('recruiter_account_edit')->middleware('rauth');

/* Rutas Videos */

Route::post('/upload-video', 'VideoController@uploadVideo')->name('upload')->middleware('cauth');

/* Rutas del chat */

Route::get('/chat','ChatController@index')->middleware('cauth');

/* Busqueda */
Route::get('searcht_results', 'TalentController@tquerySearch')->name('searcht_results')->middleware('cauth');


/* Recruiter */
Route::resource('vacant', 'VacantController');
Route::get('/recruiter-profile','RecruiterController@profile')->name('profile_recruiter')->middleware('rauth');
Route::get('/connect','RecruiterController@conex')->name('connectios_recruiter')->middleware('rauth');
Route::get('/sr/{option?}','RecruiterController@test_settings')->name('sr')->middleware('rauth');
Route::get('/search-result', 'RecruiterController@simpleSearch')->name('rec_simple_search')->middleware('rauth');
Route::get('/searchr_results', 'RecruiterController@rquerySearch')->name('searchr_results')->middleware('rauth');
/*Route::get('/accoungs','RecruiterController@test_funcion')->name('settings_recruiter')->middleware('rauth');*/
//Route::get('/new-vacant','VacantController@create')->name('create_vacant');

/* Load more jobs */

Route::get('/load_shuffle_jobs', 'TalentController@loadjobsextra')->name('loadjobsextra')->middleware('cauth');

Route::post('/apply_to_vacant', 'TalentController@applyVacant')->name('apply_vacant')->middleware('cauth');

Route::get('/get_pending_and_suggested', 'TalentController@showPConnectionsAndSuggested')->name('loadpsextra')->middleware('cauth');

/* Chat Routes */

//Route::get('/conversations', 'ChatController@dashboard')->name('dash_chat')->middleware('cauth');

Route::get('/open_conversation', 'ChatController@openFullConversation')->name('dash_chat')->middleware('cauth');

Route::post('/save-message', 'ChatController@msgSave')->middleware('cauth');

Route::get('/get-this-message', 'ChatController@retrieveMsg')->middleware('cauth');

Route::get('/open_conversations', 'ChatController@openFullConversationRec')->middleware('rauth')->name('dash_chatr');

Route::post('/save-messages', 'ChatController@msgSaveRec')->middleware('rauth');

Route::get('/get-this-messager', 'ChatController@retrieveMsgRec')->middleware('rauth');

/* [END] Chat Routes*/

/* Recruiter data for connections */

Route::get('/load_other_data', 'RecruiterController@getRightData')->middleware('rauth');

Route::get('/get_other_details_connections', 'RecruiterController@getConnectionsUsersData')->middleware('rauth');

Route::get('/add_follow_new', 'PublicoController@saveNewFollow');

/* [END] Recruiter data for connections */
Route::get('/get-load-user-detail', 'ChatController@getUserDetailsForChatMessageList')->middleware('cauth');

Route::get('/get-load-user-detail-normal', 'ChatController@getUserDetailsNormal')->middleware('cauth');

Route::get('/get-new-notifications', 'NotificationController@newNotifications')->middleware('cauth');

Route::get('/get-fb-friends', 'FacebookUser@getFbFriends')->middleware('cauth');

Route::post('/login-to-facebook', 'TalentController@loginToFacebook')->name('login_using_facebook')->middleware('cauth');

Route::get('/fb-skautin-login', 'TalentController@showFbLoginPage')->middleware('cauth');

Route::post('/change-privateaccount-status', 'TalentController@changeUserStatus')->middleware('cauth');

Route::post('/deleteuser-status', 'TalentController@deleteUser')->middleware('cauth');

Route::post('/post-edition-talent', 'TalentController@editTalent')->name('post_edition_talent')->middleware('cauth');

Route::post('/changeTalentProfileImg', 'TalentController@changeUpdateImage')->middleware('cauth');

Route::get('/get_statuses_tnotifications_now', 'TalentController@getStatusNotifications')->name('get_statuses_tnotifications_now')->middleware('cauth');

Route::post('/OFxDuJZsmVibwUEgAcVgUYhuqVqNVOtIvirHbAlAJzmx', 'TalentController@changeUpdatePass')->name('update_change_password_talent')->middleware('cauth');

Route::post('loginfb', 'FacebookUser@store');

/* Public routes Talent or Recruiter check profile */

Route::get('/view-talent-profile', 'PublicoController@viewTalentProfile')->name('public_view_talent_profile');

Route::get('/redirect-user-after-visit-talent/{id}', 'PublicoController@redirectRouteViewProfile');

Route::get('/view-edit-my-profile', 'TalentController@editViewMyProfile');

Route::post('/update-talent', 'TalentController@updateTalentInfo');

Route::get('/get-talent-vid', 'TalentController@getVideoInfo');

Route::get('/get-talent-vid-info', 'VideoController@getVidInfoById');

Route::post('/connectUsers', 'PublicoController@createNewConnection');