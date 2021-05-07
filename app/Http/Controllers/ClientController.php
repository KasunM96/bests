<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients=DB::table('clients AS c')
        ->join('users AS uf', 'uf.id', '=', 'c.user_id')
        ->select(['c.name AS name','c.id AS id','c.address AS address','c.tp AS tp','c.email AS email','c.user_id AS user_id','uf.password AS password'])
        ->get();
        return view('admin.client',compact('clients'));
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
            'name'=>'required',
            'address'=>'required',
            'tp'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required'
        ]);

        $client= new Client([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'address'=>$request->get('address'),
            'tp'=>$request->get('tp'),
        ]);
        $user = new User([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            $pwd=$request->get('password'),
            'password'=>Hash::make($pwd),
            'role'=>$request->get('role')

        ]);
        $user->save();        
        $user=User::find($user->id);
        $user->client()->save($client);
        

        return redirect('/clients')->with('success', 'Service saved!');

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
    public function update(Request $request)
    {
        //
        // dd($request);
        $id=$request->get('user_id');
        // $request->validate([

        //     'name'=>'required',
        //     'address'=>'required',
        //     'tp'=>'required',
        //     'email'=>'required',
        //     'password'=>'required',
        //     'role'=>'required'
        // ]);
        $client = Client::where('user_id',$id);       
        $client->name = $request->get('name1');
        $client->email = $request->get('email1');
        $client->address = $request->get('address1');
        $client->tp = $request->get('tp1');
        $client->save();
        
        $user = User::find($id);        
        $user->name = $request->get('name1');
        $user->email = $request->get('email1');
        $user->password = $request->get('password1');
        $user->save();



        return redirect('/clients')->with('success','Client changed');
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
        $user = User::find($id);
        $user->delete();

        $client = Client::where('user_id',$id);
        $client->delete();

        // $client=Client::find($id);
        // $client->delete();

        return redirect('/clients')->with('success','Client Deleted');
    }
}
