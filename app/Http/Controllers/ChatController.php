<?php

namespace App\Http\Controllers;

use App\Repositories\Enterprise;
use App\Repositories\Talent;
use App\Repositories\Chat;
use App\Repositories\Data2;
use App\Repositories\Data;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function dashboard() {
        return view('chat.dash');
    }

    public function openFullConversation(Request $request) {
        $ep = new Enterprise;
        $d = new Chat;
        $dataDao = new Data2;
        $model = new Data;
        $empresa = $ep->getEnterprise();
        $tmp_talent = new Talent();
        $nm = $d->all($request->session()->get('user')->email);
        $data = [
            0 => $empresa,
            'vacantes' => $tmp_talent->getOpenJobsXTalent($request->session()->get('user')->email),
            "messages" => $nm,
            "userId"=> $dataDao->getMyUserId(),
            "categories"=>$model->getCategories(),
            //"subcategories"=>$model->getSubCategories()
        ];
        return view('chat.dash')->with('data',$data);
    }

    public function openFullConversationRec(Request $request) {
        $ep = new Enterprise;
        $d = new Chat;
        $dataDao = new Data2;
        $model = new Data;
        $empresa = $ep->getEnterprise();
        $tmp_talent = new Talent();
        $nm = $d->all($request->session()->get('user')->email);
        $data = [
            0 => $empresa,
            'vacantes' => [],
            "messages" => $nm,
            "userId"=> $dataDao->getMyUserId(),
            "categories"=>$model->getCategories(),
            //"subcategories"=>$model->getSubCategories()
        ];
        return view('chat.dashr')->with('data',$data);
    }

    public function msgSave(Request $request) {
        $dataDao = new Data2;
        $dDao = new Data;
        $to = $dDao->getUserDetails($request->input('to'))->user;
        $msg = $request->input('text');
        $msgDao = new Chat;
        //return json_encode(array('to' => $to,'from' => $dataDao->getMyUserId(),'texto' => $msg,'email_temp' => session('user')->email));
        return $msgDao->guardar($to, $dataDao->getMyUserId(), $msg, session('user')->email);
    }
    public function msgSaveRec(Request $request) {
        $dataDao = new Data2;
        $dDao = new Data;
        $to = $dDao->getUserDetails($request->input('to'))->user;
        $msg = $request->input('text');
        $msgDao = new Chat;
        //return json_encode(array('to' => $to,'from' => $dataDao->getMyUserId(),'texto' => $msg,'email_temp' => session('user')->email));
        return $msgDao->guardar($to, $dataDao->getMyUserId(), $msg, session('user')->email);
    }

    public function retrieveMsg(Request $request) {
        $d = new Chat;
        //return $request->input('id');
        return json_encode($d->getChatMessageDetail($request->input('id')));
    }
    public function retrieveMsgRec(Request $request) {
        $d = new Chat;
        //return $request->input('id');
        return json_encode($d->getChatMessageDetail($request->input('id')));
    }

    public function getUserDetailsForChatMessageList(Request $request) {
        $d = new Data;
        //dd($d->getUserDetails2($request->input('id')));
        return json_encode($d->getUserDetails2($request->input('id')));
    }

    public function getUserDetailsNormal(Request $request) {
        $d = new Data;
        //dd($d->getUserDetails2($request->input('id')));
        return json_encode($d->getUserDetails($request->input('id')));
    }
}
