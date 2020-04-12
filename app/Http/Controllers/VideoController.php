<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Video;

use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function uploadVideo(Request $request) {
    	$videoModel = new Video;
    	$resultado = $videoModel->add($request->input('name'),$request->input('description'),$request->file('videosubmis'));
    	if($resultado->success = true) {
    		$request->session()->flash('suc', 'Great video is now live! :)');
    	}else {
    		$request->session()->flash('status', 'Sorry, error arrise');
    	}
    	return redirect('/view-edit-my-profile');
	}
	public function getVidInfoById(Request $request) {
		$videoDao = new Video;
        return json_encode($videoDao->getVideoById($request->input('vidid')));
    }
}
