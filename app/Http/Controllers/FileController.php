<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    //
    public function showfiles(Request $request)
    {
        // dd($request);
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

        $m_id=$request->get('id');

        $files= DB::table('files')
        ->where('message_id',$m_id)
        ->get();
        // dd($messages);
        
        return view('message.fileview',compact('files','services','users','messages'));
    }
}
