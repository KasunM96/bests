<?php

namespace App\Http\Controllers;

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
        ->join('services AS s', 's.id', '=', 'm.s_id')
        ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message'])
        ->where('m.status',1)
        ->where('uf.status',1)
        ->where('ut.status',1)
        ->get();

        // dd($messages);  

        $users=User::all();
        $services=Service::all();

        return view('message.index',compact('messages','users','services'));
        
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
        
        //
        $request->validate([
            'user'=>'required',
            'service'=>'required',
            'subject'=>'required',
            'message'=>'required'
        ]);  
        
              
        $message = new Message([
            'to' => $request->get('user'),
            'from' => Auth::id(),
            's_id' => $request->get('service'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message')
            
        ]);

        // dd($message);
        $message->save();
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
}
