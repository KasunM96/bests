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
                    <a class="nav-item nav-link" href="#">Reports</a>
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
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body inbox-menu">
                                
                                <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#messagemodal" >New Email</button>
                                <ul>
                                    <li>
                                        <a href="{{url('/message-inbox')}}"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger">4</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-star"></i> Stared</a>
                                    </li>
                                    <li>
                                        <a href="{{route('messages.index')}}"><i class="fa fa-rocket"></i> Sent</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-trash-o"></i> Trash</a>
                                    </li>
                                    
                                </ul>
                                
                            </div>	
                            
                        </div>
                        
                        
                        
                    </div><!--/.col-->
                    
                    <div class="col-md-9">
                        <div class="panel panel-default" id="messages-lists">
                            @yield('messages')
                            

                           
                            
                        </div>	
                        
                    </div><!--/.col-->	
                            
                </div>
                </div>




            
        </div>
    </div>
</div>




  <!--Message Modal -->
<div class="modal fade" id="messagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('messages.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">Select a Client</label>
                        <select class="form-control input" name="user" id="user" >
                            <option selected disabled>Please select a Client</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="service">Select a Service </label>
                        <select class="form-control input" name="service" id="service" >
                            <option selected disabled>Please select an User</option>
                            @foreach($services as $service)
                                <option value="{{$service->id}}">{{$service->s_name}}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <textarea rows="4" cols="50" class="form-control" id="message" name="message">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="file" name="filesu[]" multiple>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="SEND">
                </div>
            </form>
        </div>
    </div>
</div> 



<!--Message view Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message </h5>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <span id="m-box">  </span> : <span id="m-person"></span>
                        <h5 id="m-subject"></h5>
                        <p id="m-body"></p>

                    </div>
            
                    <form action="{{url('showfiles/')}}" method="post" >
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <input type="submit" value="View Files">
                        
                    </form>
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
