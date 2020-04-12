<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Vacant;
use App\Repositories\Enterprise;
use App\Repositories\Talent;

class DashboardController extends Controller
{
    public function homeTalent(Request $request){
        return view('new_refactor.home_talent');
    }

    public function homeRecruiter(Request $request) {
        return view('new_refactor.home_recruiter');
    }
}
