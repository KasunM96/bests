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
                        <a class="nav-item nav-link" href="{{url('user-view/')}}">Users</a>
                        <a class="nav-item nav-link " href="{{route('clients.index')}}">Clients </a>
                        <a class="nav-item nav-link active" href="{{url('viewr/')}}">Reports</a>
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
                <form action="{{url('reports/')}}" method="post">
                    @csrf


                    <h6>Select a Client .....    Select a Service</h6>  <select name="client" id="client">
                            <option value="*">All</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                            
                        @endforeach
                    </select>
                    
                     <select name="service" id="service">
                            <option value="*">All</option>
                        @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->s_name}}</option>
                            
                        @endforeach
                    </select>

                    <input type="submit" class="btn btn-success" value="Filter"> Results <span class="badge badge-info">  <h6>{{$count}}</h6></span>
                    
                    
                </form>
                
            </div>

            <table class="table table-tripped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>email</td>
                        <td>Telephone</td>
                        <td>Address</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->subject}}</td>
                        <td>{{$report->message}}</td>
                        <td>{{$report->email}}</td>
                        <td>{{$report->tp}}</td>
                        <td>{{$report->address}}</td>

                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
               




            
        </div>
    </div>
</div>




 


@endsection

@section('endscript')
<script>
    // $(document).on("click","#edit-btn",function(){
    //     var id=$(this).data("id");
    //     var name=$(this).data("name");
    //     var address=$(this).data("address");
    //     var tp=$(this).data("tp");
    //     var email=$(this).data("email");
    //     var password=$(this).data("password");
    //     var user_id=$(this).data("userid");

    //     $("#id1").val(id);
    //     $("#name1").val(name);
    //     $("#address1").val(address);
    //     $("#tp1").val(tp);
    //     $("#email1").val(email);
    //     $("#password1").val(password);
    //     $("#user_id").val(user_id);
    //     console.log(id);
    // });

</script>
    
@endsection
