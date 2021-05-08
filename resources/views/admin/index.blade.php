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
                        <a class="nav-item nav-link active" href="{{route('services.index')}}">Services</a>
                        <a class="nav-item nav-link" href="{{route('clients.index')}}">Clients </a>
                        <a class="nav-item nav-link" href="{{url('viewr/')}}">Reports</a>
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
                    <h4>Click here to add a Service or Product..!</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#servicemodal" >Add Service</button>
                </div>

                <table class="table table-tripped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name of the Service Or Product</td>
                            <td>Description</td>
                            <td>Approximate Time</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>{{$service->s_name}}</td>
                            <td>{{$service->s_description}}</td>
                            <td>{{$service->s_duration}}</td>
                            <td>
                                <button id="edit-btn" class="btn btn-primary" data-target="#editmodal" data-toggle="modal" data-id="{{$service->id}}" data-name="{{$service->s_name}}" 
                                    data-description="{{$service->s_description}}" data-duration="{{$service->s_duration}}" >Edit</button>
                            </td>
                            <td>
                                <form action="{{route('services.destroy',$service->id)}}" method="POST">
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




  <!--Service Modal -->
<div class="modal fade" id="servicemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('services.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product Or Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="s_name">Service or Product Name</label>
                        <input type="text" class="form-control" id="s_name" name="s_name" aria-describedby="emailHelp" placeholder="Enter Service or Product name" required>
                    </div>
                    <div class="form-group">
                        <label for="s_duration">Approximate Delivery Time</label>
                        <input type="text" class="form-control" id="s_duration" name="s_duration" aria-describedby="emailHelp" placeholder="Enter Approximate Duration" required>
                    </div>
                    <div class="form-group">
                        <label for="s_description">Description</label>
                        <input type="textarea" class="form-control" id="s_description" name="s_description" aria-describedby="emailHelp" placeholder="Add Short Description" required>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="ADD">
                </div>
            </form>
        </div>
    </div>
</div>
  <!--Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <form method="post" action="{{url('services-update')}}" >
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
 


@endsection

@section('endscript')
<script>
    $(document).on("click","#edit-btn",function(){
        var id=$(this).data("id");
        var name=$(this).data("name");
        var description=$(this).data("description");
        var duration=$(this).data("duration");

        $('#formId').attr('action', 'page1');
        $("#id1").val(id);
        $("#s_name1").val(name);
        $("#s_description1").val(description);
        $("#s_duration1").val(duration);
        console.log(id);
    });

</script>
    
@endsection
