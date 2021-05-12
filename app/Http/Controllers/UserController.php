<?php

namespace App\Http\Controllers;

use App\Client;
use App\File;
use App\Message;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $clients=Client::all();

        // if(Auth::user()->role==1)
        
        return view('email.send',compact('messages','users','services','files','clients'));
    }
    public function view(){
        $users=DB::table('users AS u')
        ->where('u.id','<>',Auth::id())
        ->get();

        $services=Service::all();
        return view('admin.user',compact('users','services'));

    }

    public function store(Request $request)
    {
        // dd($request);
        //
        // $request->validate([
        //     'name'=>'required',
        //     'address'=>'required',
        //     'tp'=>'required',
        //     'email'=>'required',
        //     'password'=>'required',
        //     'role'=>'required'
        // ]);

        $user= new User([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=>Hash::make($request->get('password1')),
            'role'=>$request->get('role')
        ]);
        
        $user->save();
        

        return redirect('/user-view')->with('success', 'Service saved!');

    }

    public function update(Request $request)
    {
        //
        // dd($request);
        $id=$request->get('id');
        // $request->validate([

        //     'name'=>'required',
        //     'address'=>'required',
        //     'tp'=>'required',
        //     'email'=>'required',
        //     'password'=>'required',
        //     'role'=>'required'
        // ]);
        $client = User::where('id',$id)->first();       
        $client->name = $request->get('name1');
        $client->email = $request->get('email1');
        $client->save();

        // dd($client);
        
        



        return redirect('/user-view')->with('success','Client changed');
    }

    public function destroy($id)
    {
        //       

        $client = User::where('id',$id);
        $client->delete();

        // $client=Client::find($id);
        // $client->delete();

        return redirect('/user-view')->with('success','Client Deleted');
    }
}
