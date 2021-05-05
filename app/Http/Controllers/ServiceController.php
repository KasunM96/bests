<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services=Service::all();
        return view('admin.index',compact('services'));
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
            's_name'=>'required',
            's_description'=>'required',
            's_duration'=>'required'
        ]);        
        $service = new Service([
            's_name' => $request->get('s_name'),
            's_description' => $request->get('s_description'),
            's_duration' => $request->get('s_duration')
            
        ]);
        $service->save();
        return redirect('/services')->with('success', 'Service saved!');
        
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
        $service=Service::find($id);
        return view('admin.index',compact('service'));
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
        // $request->validate([
        //     's_name'=>'required',
        //     's_description'=>'required',
        //     's_duration'=>'required',
        // ]);
        // dd($request->request);
        $id = $request->id1;

        $service = Service::find($id);
        // dd($service);
        $service->s_name = $request->get('s_name1');
        $service->s_description = $request->get('s_duration1');
        $service->s_duration = $request->get('s_description1');
        $service->save();

        return redirect('/admin')->with('success','Service saved');
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
        $service=Service::find($id);
        $service->delete();

        return redirect('/admin')->with('success','Service Deleted');
    }
}
