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
            // ->join('users AS uf', 'uf.id', '=', 'm.from')
            ->join('users AS ut', 'ut.id', '=', 'm.to')
            ->join('services AS s', 's.id', '=', 'm.s_id')
            ->join('clients AS c', 'c.user_id', '=', 'ut.id')
            ->select(['ut.name AS name','m.subject AS subject','m.message AS message','m.id AS id','c.address as address','c.tp as tp','c.email as email'])
            ->get();
            // dd($reports);
            $count=$reports->count();
            

        }
        elseif(($client=='*') or ($service=='*'))
        {
            
            if($client=='*')
            {
                
                $reports=DB::table('messages AS m')
                ->join('users AS ut', 'ut.id', '=', 'm.to')
                ->join('services AS s', 's.id', '=', 'm.s_id')
                ->join('clients AS c', 'c.user_id', '=', 'ut.id')
                ->select(['ut.name AS name','m.subject AS subject','m.message AS message','m.id AS id','c.address as address','c.tp as tp','c.email as email'])
                ->orWhere('m.s_id',$service)
                ->get();
                // dd($reports);
                $count=$reports->count();
                
            }
            if($service=='*')
            {
                $reports=DB::table('messages AS m')
                ->join('users AS ut', 'ut.id', '=', 'm.to')
                ->join('services AS s', 's.id', '=', 'm.s_id')
                ->join('clients AS c', 'c.user_id', '=', 'ut.id')
                ->select(['ut.name AS name','m.subject AS subject','m.message AS message','m.id AS id','c.address as address','c.tp as tp','c.email as email'])
                ->orWhere('m.to',$client)
                ->get();
                $count=$reports->count();


            }
        }
        else
        {
            $reports=DB::table('messages AS m')
            ->join('users AS ut', 'ut.id', '=', 'm.to')
            ->join('services AS s', 's.id', '=', 'm.s_id')
            ->join('clients AS c', 'c.user_id', '=', 'ut.id')
            ->select(['ut.name AS name','m.subject AS subject','m.message AS message','m.id AS id','c.address as address','c.tp as tp','c.email as email'])
            ->orWhere('m.to',$client)
            ->orWhere('m.s_id',$service)
            ->get();
            $count=$reports->count();


        }

        
        

        // dd($reports);  


        $services=Service::all();
        $clients=Client::all();
        // dd($clients);
        return view('admin.report',compact('reports','clients','services','count'));
       
    }
    
    public function viewr()
    {
        
        
        $reports=DB::table('messages AS m')
        // ->join('users AS uf', 'uf.id', '=', 'm.from')
        ->join('users AS ut', 'ut.id', '=', 'm.to')
        ->join('services AS s', 's.id', '=', 'm.s_id')
        ->join('clients AS c', 'c.user_id', '=', 'ut.id')
        ->select(['ut.name AS name','m.subject AS subject','m.message AS message','m.id AS id','c.address as address','c.tp as tp','c.email as email'])
        ->get();
        // dd($reports);
        $count=$reports->count();

        // dd($reports);  


        $services=Service::all();
        $clients=Client::all();
        // dd($clients);
        return view('admin.report',compact('reports','clients','services','count'));
       
    }
}
