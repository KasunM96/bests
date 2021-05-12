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
                        <a class="nav-item nav-link active" href="{{url('user-view/')}}">Users</a>
                        <a class="nav-item nav-link " href="{{route('clients.index')}}">Clients </a>
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
                    <h4>Click here to add an User</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addmodal" >Add User</button>
                </div>

                <table class="table table-tripped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Password</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                           
                            <td>
                                <button id="edit-btn" class="btn btn-primary" data-target="#editmodal" data-toggle="modal"  data-id="{{$user->id}}"  
                                    data-name="{{$user->name}}" data-email="{{$user->email}}"  >Edit</button>
                            </td>
                            <td>
                                <form action="{{route('users.destroy',$user->id)}}" method="POST">
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
            <form action="{{route('users.store')}}" method="post" name="addclient">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name">User's Name</label>
                    <div class="form-group">                                       
                        <input type="text" class="form-control" id="name_c" name="name" aria-describedby="emailHelp" aria-describedby="validationTooltipUsernamePrepend" placeholder="Enter Client's Name" required>
                        <span class="err_form" id="name_error"> </span>
                    </div>
  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email_c" name="email" aria-describedby="emailHelp" placeholder="Add Email" required>
                        <span class="err_form" id="email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" aria-describedby="emailHelp" placeholder="Add New Password" required>
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
            <form method="post" action="{{url('user-update/')}}">  
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Clients Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden"  id="user_id" name="id" >
                        <label for="name">Client's Name</label>
                        <input type="text" class="form-control" id="name1" name="name1" aria-describedby="emailHelp" placeholder="Enter Client's Name" required>
                    </div>                  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email1" name="email1" aria-describedby="emailHelp" placeholder="Add Email" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" aria-describedby="emailHelp" placeholder="Add New Password" required>
                    </div> --}}
                    
    
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
        $("#user_id").val(id);
        console.log(id);
    });

    $(function(){
        $("#name_error").hide();
        $("#address_error").hide();
        $("#email_error").hide();
        $("#tp_error").hide();
        $("#pwd_error").hide();

        var error_name= false;
        var error_address= false;
        var error_email= false;
        var error_tp= false;
        var error_pwd= false;

        $("#name_c").focusout(function(){
            check_name();

        });
        $("#address_c").focusout(function(){
            check_address();
        });
        $("#email_c").focusout(function(){
            check_email();
        });
        $("#tp_c").focusout(function(){
            check_tp();
        });
        $("#password_c").focusout(function(){
            check_password();
        });


        function check_name(){

            var pattern= /^[a-zA-Z]*$/;
            var name= $("#name_c").val();
            console.log(name);
            if(name==""){
                $("#name_c").css('border-color','red');
                error_name= "Enter client's business name";
                $("#name_error").html(error_name);
                $("#name_error").css('color','red');
                $("#name_error").show();

            } else {
                $("#name_c").css('border-color','green');
                error_name= "Perfect";
                $("#name_error").html(error_name);
                $("#name_error").css('color','green');
                $("#name_error").show();

            }
            
            // if(pattern.test(name) && (name !=='')){
            //     $("#name_error").hide();
            //     // $("#name").hide();
            // }else{
            //     $("#name_error").html("should only include chars");
            //     $("#name_error").show();
            //     // $("#name").show();
            //     error_name=true;
        }

        function check_address(){
            
            var address= $("#address_c").val();
  
            if(address==""){
                $("#address_c").css('border-color','red');
                var error_address= "Enter client's address";
                $("#address_error").html(error_address);
                $("#address_error").css('color','red');
                $("#address_error").show();

            } else {
                $("#address_c").css('border-color','green');
                var error_address= "Perfect";
                $("#address_error").html(error_address);
                $("#address_error").css('color','green');
                $("#address_error").show();

            }
            
        }         
        
        
        function check_tp(){
            
            var tp= $("#tp_c").val();
            var pattern= /[0-9 -()+]+$/;
         
            if(tp==""){
                $("#tp_c").css('border-color','red');
                var error_tp= "Enter client's Telephone number";
                $("#tp_error").html(error_tp);
                $("#tp_error").css('color','red');
                $("#tp_error").show();

            }
            else if((tp.length!=10) || (!pattern.test(tp)) ){
                $("#tp_c").css('border-color','red');
                var error_tp= "Enter a Valid Number";
                $("#tp_error").html(error_tp);
                $("#tp_error").css('color','red');
                $("#tp_error").show();

            }
             else {
                $("#tp_c").css('border-color','green');
                var error_tp= "Perfect";
                $("#tp_error").html(error_tp);
                $("#tp_error").css('color','green');
                $("#tp_error").show();

            }
            
        }
        
        function check_email(){
            
            var email= $("#email_c").val();
            var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
         
            if(email==""){
                $("#email_c").css('border-color','red');
                var error_email= "Enter client's Email address";
                $("#email_error").html(error_email);
                $("#email_error").css('color','red');
                $("#email_error").show();

            }
            else if(!mailformat.test(email)) {
                $("#email_c").css('border-color','red');
                var error_email= "Enter a Valid Email";
                $("#email_error").html(error_email);
                $("#email_error").css('color','red');
                $("#email_error").show();

            }
             else {
                $("#email_c").css('border-color','green');
                var error_email= "Perfect";
                $("#email_error").html(error_email);
                $("#email_error").css('color','green');
                $("#email_error").show();

            }
            
        }

        function check_password(){
            
            var password= $("#password_c").val();
  
            
            if((password=="")||(password.length<5)) {
                $("#password_c").css('border-color','red');
                var error_pwd= "Enter at least 5 characters ";
                $("pwd_error").show();
                $("pwd_error").html(error_pwd);
                $("pwd_error").css('color','red');
                
            }
            
            else {
                $("#password_c").css('border-color','green');
                var error_pwd= "Perfect";
                $("#pwd_error").html(error_pwd);
                $("#pwd_error").css('color','green');
                $("#pwd_error").show();

            }
            
        }                 
     

       
        
    });
    

   
</script>
    
@endsection
