@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-4 text-center">
            <h1 class='text-white'>Unique Login Form</h1>
              <div class="form-login"></br>
                <h4>Secure Login</h4>
                </br>
                <input type="text" id="userName" class="form-control input-sm chat-input" placeholder="username"/>
                </br></br>
                <input type="text" id="userPassword" class="form-control input-sm chat-input" placeholder="password"/>
                </br></br>
                <div class="wrapper">
                        <span class="group-btn">
                            <a href="#" class="btn btn-danger btn-md">login <i class="fa fa-sign-in"></i></a>
                        </span>
                </div>
            </div>
        </div>
    </div>
    </br></br></br>
@endsection
