<?php

namespace App\Http\Controllers;

use App\File;
use App\Message;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $message=Message::all();

        $messages=DB::table('messages AS m')
        ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
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
    public function userindex()
    {
        //
        
        $message=Message::all();

        $messages=DB::table('messages AS m')
        ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
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
        
        return view('user.index',compact('messages','users','services','files'));
        
    }
    public function inbox()
    {
        $message=Message::all();

        $messages=DB::table('messages AS m')
        ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
        ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
        ->where('m.status',1)
        ->where('uf.status',1)
        ->where('ut.status',1)
        ->where('m.to',Auth::id())
        ->get();

        // dd($messages);  

        $users=DB::table('users AS u')
        ->where('u.id','<>',Auth::id())
        ->get();

        $services=Service::all();
        $files=File::all();

        return view('message.inbox',compact('messages','users','services','files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        
        
        $message = new Message();
        $message->to=$request->get('user');
        $message->from=Auth::id();
        $message->s_id=$request->get('service');
        $message->subject=$request->get('subject');
        $message->message=$request->get('message');
        $message->save();
       
        

        if($request->hasFile('filesu'))
        {
            $message_id=$message->id;
            $files=$request->file('filesu');
            foreach ($files as $file){
                $destinationPath = 'upload/';
                
                $name=time().'-'.$file->getClientOriginalName();
                
                // $extension=$file->getClientOriginalExtension();
                $file->move($destinationPath,$name);
                $ufiles= new File();
                $ufiles->location= $name;
                $ufiles->message_id= $message_id;
                $ufiles->save();
            }

        }

        
       
        

        
        
        return redirect('/messages')->with('success', 'Message sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function inboxx()
    {
        // dd($id);

        $messages=DB::table('messages AS m')
        ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
        ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message'])
        ->where('m.status',1)
        ->where('uf.status',1)
        ->where('ut.status',1)
        ->get();

        // dd($messages);  

        $users=User::all();
        $services=Service::all();

        return view('message.inbox',compact('messages','users','services'));
    }
}
