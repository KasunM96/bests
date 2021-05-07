@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/message.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('title')
<title>User Dashboard</title>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="navbar-nav">
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
