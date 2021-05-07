@extends('layouts.app')



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
                        <a class="nav-item nav-link active" href="{{route('clients.index')}}">Clients </a>
                        <a class="nav-item nav-link" href="#">Reports</a>
                        <a class="nav-item nav-link" href="{{route('messages.index')}}">Message</a>
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
                    <h4>Click here to add a Client</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addmodal" >Add Client</button>
                </div>

                <table class="table table-tripped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Address</td>
                            <td>Email</td>
                            <td>Telephone Number</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->address}}</td>
                            <td>{{$client->email}}</td>
                            <td>{{$client->tp}}</td>
                            <td>
                                <button id="edit-btn" class="btn btn-primary" data-target="#editmodal" data-toggle="modal" data-userid="{{$client->user_id}}" data-id="{{$client->id}}"  
                                    data-name="{{$client->name}}" data-address="{{$client->address}}" data-tp="{{$client->tp}}" data-email="{{$client->email}}" data-password="{{$client->password}}" >Edit</button>
                            </td>
                            <td>
                                <form action="{{route('clients.destroy',$client->user_id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>




            
        </div>
    </div>
</div>




  <!--Add Client-->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('clients.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Clients</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Client's Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Client's Name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Client's Address</label>
                        <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" placeholder="Enter Client's Address" required>
                    </div>
                    <div class="form-group">
                        <label for="tp">Telephone Number</label>
                        <input type="text" class="form-control" id="tp" name="tp" aria-describedby="emailHelp" placeholder="Add Telephone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Add Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Add Password" required>
                    </div>
                    <input type="hidden" id="role" name="role" value="2">
                    
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="ADD">
                </div>
            </form>
        </div>
    </div>
</div>


  <!--Edit Client-->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('client-update')}}" >
                
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Clients Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden"  id="user_id" name="user_id" >
                        <label for="name">Client's Name</label>
                        <input type="text" class="form-control" id="name1" name="name1" aria-describedby="emailHelp" placeholder="Enter Client's Name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Client's Address</label>
                        <input type="text" class="form-control" id="address1" name="address1" aria-describedby="emailHelp" placeholder="Enter Client's Address" required>
                    </div>
                    <div class="form-group">
                        <label for="tp">Telephone Number</label>
                        <input type="text" class="form-control" id="tp1" name="tp1" aria-describedby="emailHelp" placeholder="Add Telephone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email1" name="email1" aria-describedby="emailHelp" placeholder="Add Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" aria-describedby="emailHelp" placeholder="Add New Password" required>
                    </div>
                    
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes">
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
</div>
  --}}


@endsection

@section('endscript')
<script>
    $(document).on("click","#edit-btn",function(){
        var id=$(this).data("id");
        var name=$(this).data("name");
        var address=$(this).data("address");
        var tp=$(this).data("tp");
        var email=$(this).data("email");
        var password=$(this).data("password");
        var user_id=$(this).data("userid");

        $("#id1").val(id);
        $("#name1").val(name);
        $("#address1").val(address);
        $("#tp1").val(tp);
        $("#email1").val(email);
        $("#password1").val(password);
        $("#user_id").val(user_id);
        console.log(id);
    });

</script>
    
@endsection
