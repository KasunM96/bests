<?php

namespace App\Http\Controllers;

use App\File;
use App\Message;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index(){
        // return view('user.index');

        $message=Message::all();

        $messages=DB::table('messages AS m')
        ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
        ->join('services AS s', 's.id', '=', 'm.s_id')
        ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
        ->where('m.status',1)
        ->where('uf.status',1)
        ->where('ut.status',1)
        ->where('m.from',Auth::id())
        ->get();

        // dd($messages);  

        $users=DB::table('users AS u')
        ->where('u.id','<>',Auth::id())
        ->get();

        $services=Service::all();
        $files=File::all();

        // if(Auth::user()->role==1)
        
        return view('message.index',compact('messages','users','services','files'));
    }
}
