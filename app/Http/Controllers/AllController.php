<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllController extends Controller
{
    public function authenticate(Request $request) {
        $input = $request->all();
        if($input['user'] === "alejandro.davalos@gmail.com" && $input['pass'] === "123456") {
            $authenticatedK = date('Y-m-d H:i:s', strtotime('now'));
            session(['authenticatedUser', $authenticatedK]);
            return json_encode(array('status' => true));
        }
        return json_encode(array('status' => false));
    }

    public function home(Request $request) {
        dd("Hi you are in home" . session('authenticatedUser'));
    }
}
