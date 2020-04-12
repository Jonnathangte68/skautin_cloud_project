<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\User;
// use App\Repositories\Data;
use App\Jobs\BinformationJob;
use App\Data;
use Artisan;
use \App\UserSession;

class HomeController extends Controller
{
    protected $user;


    public function __construct(User $user) {
        $this->user = $user;
    }

    public function iniciarSesion(Request $request)
    {
        $data = $request->only(['username', 'password']);
        if (!$data['username'] || !$data['password']) {
            $request->session()->flash('status', 'Invalid username and/or password combination, please try again.');
            return redirect()->action('PublicoController@welcome');
        }
        $user = \App\Data::where('email', $data['username'])->first();
        if (!$user) {
            $request->session()->flash('status', 'Invalid username and/or password combination, please try again.');
            return redirect()->action('PublicoController@welcome');
        }
        if ($user->password !== $data['password']) {
            $request->session()->flash('status', 'Invalid username and/or password combination, please try again.');
            return redirect()->action('PublicoController@welcome');
        }
        // Authenticate session
        $sessionUser = new UserSession($user->name, $user->email, $user->user_type);
        $request->session()->put('authenticatedUser', $sessionUser);
        if ($user->user_type === "recruiter") {
            return redirect()->action('DashboardController@homeRecruiter');
        } else {
            return redirect()->action('DashboardController@homeTalent');
        }
    }

    public function registerUser(Request $request) {
        $generateProfilePictureId = $this->generateRandomString(30);
        $profilePicturePath = $request->pic->storeAs('images', $generateProfilePictureId . '.jpg');
        $storeData = $request->all();
        $dataDAO = new Data();

        $dataDAO->email = $storeData['username'];
        $dataDAO->password = $storeData['password1'];
        $dataDAO->name = $storeData['name'];
        $dataDAO->gender = $storeData['gender'];
        $dataDAO->birth_year = $storeData['yearofbirth'];
        $dataDAO->country = $storeData['country'];
        $dataDAO->state = $storeData['state'];
        $dataDAO->city = $storeData['city'];
        $dataDAO->categories = json_encode($storeData['categorieschk']);
        $dataDAO->subcategories = json_encode($storeData['subcategory']);
        $dataDAO->picture_uri = $profilePicturePath;
        $dataDAO->user_type = $storeData['user_type'];

        // Save recruiter
        if ($storeData['user_type']==="recruiter") {
            if ($storeData['rtype'] === "1") {
                $dataDAO->org_name = $storeData['organization'];
                $dataDAO->org_website = $storeData['website'];
                $dataDAO->org_phone = $storeData['organization_phone'];
            }
            $dataDAO->criteria_age_range = json_encode($storeData['ages']);
            $dataDAO->criteria_genre = json_encode($storeData['interestgender']);
            $dataDAO->criteria_level = json_encode($storeData['levels']);
            $dataDAO->save();
            $request->session()->flash('suc', 'Successful User Registration, Instructions to access your account have been sent to you by email');
            return redirect()->action('PublicoController@welcome');
        }

        // Save talent
        $dataDAO->level = $storeData['level'];
        $dataDAO->save();
        $request->session()->flash('suc', 'Successful User Registration, Instructions to access your account have been sent to you by email');
        return redirect()->action('PublicoController@welcome');
    }

    public function showNewTalentReg() {
        return view('registration_talent');
    }

    public function showNewRecruiterReg() {
        return view('registration_recruiter');
    }

    public function showPreviewTalentProfile(Request $request, $id) {
        return view('new_refactor.preview_talent_profile');
    }

    public function showRecruiterJobs() {
        dd('test completed.');
    }

    public function getCountriesAjax(Request $request, Response $response) {
        $model = new Data(); // By use
        $ct = $model->getCountries();
        $aux = array();
        $substr = $request->input('q');
        foreach ($ct as $country) {
            if (strpos($country->name, $substr) !== false) {
                array_push($aux, array('label'=>$country->name, 'value'=>$country->_id));
            }
        }
        $js = json_encode($aux);
        return $js;
    }

    public function getStatesAjax(Request $request, Response $response) {
        $model = new Data(); // By use
        $ct = $model->getStates();
        $aux = array();
        $substr = $request->input('q');
        foreach ($ct as $state) {
            if (strpos($state->name, $substr) !== false) {
                array_push($aux, array('label'=>$state->name, 'value'=>$state->_id));
            }
        }
        $js = json_encode($aux);
        return $js;
    }

    public function getCitiesAjax(Request $request, Response $response) {
        $model = new Data(); // By use
        $ct = $model->getCities();
        $aux = array();
        $substr = $request->input('q');
        foreach ($ct as $city) {
            if (strpos($city->name, $substr) !== false) {
                array_push($aux, array('label'=>$city->name, 'value'=>$city->_id));
            }
        }
        $js = json_encode($aux);
        return $js;
    }

    public function getSubsXCateg($categoria) {
        $model = new Data();
        return json_encode($model->getSubsXcategory($categoria));
    }

    public function logOut(Request $request) {
        Artisan::call('cache:clear');
        // $request->session()->invalidate();
        $request->session()->put('authenticatedUser', 'false');
        return redirect('/');
    }

    protected function generateRandomString($length = 35) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
