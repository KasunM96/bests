<?php

namespace App\Http\Controllers;

use App\Client;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function getreport(Request $request)
    {
        $client=$request->client;
        $service=$request->service;
        // dd($client);
        if(($client=='*') and ($service=='*') )
        {
            $reports=DB::table('messages AS m')
            ->join('users AS uf', 'uf.id', '=', 'm.from')
            ->join('users AS ut', 'ut.id', '=', 'm.to')
            ->join('services AS s', 's.id', '=', 'm.s_id')
            ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
            ->get();

        }
        elseif(($client=='*') or ($service=='*'))
        {
            if($client=='*')
            {
                $reports=DB::table('messages AS m')
                ->join('users AS uf', 'uf.id', '=', 'm.from')
                ->join('users AS ut', 'ut.id', '=', 'm.to')
                ->join('services AS s', 's.id', '=', 'm.s_id')
                ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
                ->where('m.s_id',$service)
                ->get();
            }
            if($service=='*')
            {
                $reports=DB::table('messages AS m')
                ->join('users AS uf', 'uf.id', '=', 'm.from')
                ->join('users AS ut', 'ut.id', '=', 'm.to')
                ->join('services AS s', 's.id', '=', 'm.s_id')
                ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
                ->where('m.s_id',$service)
                ->get();

            }
        }
        else
        {
            $reports=DB::table('messages AS m')
            ->join('users AS uf', 'uf.id', '=', 'm.from')
            ->join('users AS ut', 'ut.id', '=', 'm.to')
            ->join('services AS s', 's.id', '=', 'm.s_id')
            ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
            ->where('m.to',$client)
            ->orWhere('m.s_id',$service)
            ->get();

        }

        
        

        // dd($reports);  


        $services=Service::all();
        $clients=Client::all();
        // dd($clients);
        return view('admin.report',compact('reports','clients','services'));
       
    }
    
    public function viewr()
    {
        
        
        $reports=DB::table('messages AS m')
        ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
        ->join('services AS s', 's.id', '=', 'm.s_id')
        ->select(['uf.name AS from','ut.name AS to','m.subject AS subject','m.message AS message','m.id AS id'])
        ->where('m.status',1)
        ->where('uf.status',1)
        ->where('ut.status',1)
        ->where('m.from',Auth::id())
        ->get();

        // dd($reports);  


        $services=Service::all();
        $clients=Client::all();
        // dd($clients);
        return view('admin.report',compact('reports','clients','services'));
       
    }
}
