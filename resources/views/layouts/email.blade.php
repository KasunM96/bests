@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/message.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('title')
@if (Auth::user()->role==1)
<title>Admin Dashboard</title>
@endif
@if (Auth::user()->role==2)
<title>User Dashboard</title>
@endif
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">

            @if (Auth::user()->role==1)
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="{{route('services.index')}}">Services</a>
                    <a class="nav-item nav-link" href="{{route('clients.index')}}">Clients </a>
                    <a class="nav-item nav-link" href="{{url('viewr/')}}">Reports</a>
                    <a class="nav-item nav-link active" href="{{route('messages.index')}}">Message</a>
                </div>
            </nav>
                
            @endif
            @if (Auth::user()->role==2)
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="{{route('messages.index')}}">Message</a>
                </div>
            </nav>
                
            @endif

                

            
            </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    {{-- {{$user_data}} --}}
                    
                   
                </div>

               
                
                <div class="container">
                <div class="row inbox">
                    {{-- <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body inbox-menu">
                                
                                <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#messagemodal" >New Email</button>
                                <ul>
                                    <li>
                                        <a href=""><i class="fa fa-inbox"></i> Inbox <span class="label label-danger">4</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-star"></i> Stared</a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa fa-rocket"></i> Sent</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-trash-o"></i> Trash</a>
                                    </li>
                                    
                                </ul>
                                
                            </div>	
                            
                        </div>
                        
                        
                        
                    </div><!--/.col--> --}}
                    
                    <div class="col-md-9 mx-auto">
                        <div class="panel panel-default" id="messages-lists">
                            @yield('messages')
                            

                           
                            
                        </div>	
                        
                    </div><!--/.col-->	
                            
                </div>
                </div>




            
        </div>
    </div>
</div>




 


@endsection

@section('endscript')
<script>
    $(document).on("click","#modallink",function(){
        var person=$(this).data("person");
        var id=$(this).data("id");
        var subject=$(this).data("subject");
        var body=$(this).data("body");
        var box=$(this).data("box");

        console.log(id);

        $("#m-person").text(person);
        $("#m-subject").text(subject);
        $("#m-body").text(body);
        $("#m-box").text(box);
        $("#id").val(id);
        // $("#s_duration1").val(duration);
        // console.log(id);
    });

</script>
    
@endsection
