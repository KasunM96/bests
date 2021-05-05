@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/message.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('title')
<title>Admin Dashboard</title>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="{{route('services.index')}}">Services</a>
                        <a class="nav-item nav-link" href="{{route('clients.index')}}">Clients </a>
                        <a class="nav-item nav-link" href="#">Reports</a>
                        <a class="nav-item nav-link active" href="{{route('messages.index')}}">Message</a>
                    </div>
                </nav>
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
                                        <a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger">4</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-star"></i> Stared</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-rocket"></i> Sent</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-trash-o"></i> Trash</a>
                                    </li>
                                    
                                </ul>
                                
                            </div>	
                            
                        </div>
                        
                        
                        
                    </div><!--/.col-->
                    
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-body">
                               
                                <ul class="messages-list">
                                    @foreach ($messages as $message)

                                    <li class="unread">
                                        <a href="page-inbox-message.html">
                                            <div class="header">
                                                <span class="action"><i class="fa fa-square-o"></i><i class="fa fa-square"></i></span> 
                                                <span class="from">{{$message->from}}</span>
                                                <span class="date"><span class="fa fa-paper-clip"></span> Today, 3:47 PM</span>
                                            </div>
                                            <div class="title">
                                                <span class="action"><i class="fa fa-star-o"></i><i class="fa fa-star bg"></i></span>
                                                {{$message->subject}}
                                            </div>	
                                            <div class="description">
                                                {{$message->message}}
                                            </div>
                                        </a>		
                                    </li>
                                        
                                    @endforeach

                                </ul>
                                
                            </div>	
                            
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
            <form action="{{route('messages.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">Select a User</label>
                        <select class="form-control input" name="user" id="user" >
                            <option selected disabled>Please select an User</option>
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
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="SEND">
                </div>
            </form>
        </div>
    </div>
</div>

  {{-- <!--Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('services.update',$service->id)}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Or Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="id1" name="id1">
                    <div class="form-group">
                        <label for="s_name">Service or Product Name</label>
                        <input type="text" class="form-control" id="s_name1" name="s_name1"  aria-describedby="emailHelp" placeholder="Enter Service or Product name" required>
                    </div>
                    <div class="form-group">
                        <label for="s_duration">Approximate Delivery Time</label>
                        <input type="text" class="form-control" id="s_duration1" name="s_duration1"   aria-describedby="emailHelp" placeholder="Enter Approximate Duration" required>
                    </div>
                    <div class="form-group">
                        <label for="s_description">Description</label>
                        <input type="textarea" class="form-control" id="s_description1" name="s_description1"   aria-describedby="emailHelp" placeholder="Add Short Description" required>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </form>
        </div>
    </div>
</div> --}}
 


@endsection

@section('endscript')
<script>
    // $(document).on("click","#edit-btn",function(){
    //     var id=$(this).data("id");
    //     var name=$(this).data("name");
    //     var description=$(this).data("description");
    //     var duration=$(this).data("duration");

    //     $("#id1").val(id);
    //     $("#s_name1").val(name);
    //     $("#s_description1").val(description);
    //     $("#s_duration1").val(duration);
    //     console.log(id);
    // });

</script>
    
@endsection
