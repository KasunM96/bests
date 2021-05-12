@extends('layouts.email')
@section('messages')
Send emails
<div class="panel-body">
   
    <form class="form-horizontal" role="form"  action="sendattachmentemail/" method="post" enctype="multipart/form-data">
          @csrf
      <div class="form-group">
            <label for="from" class="col-sm-1 control-label">From:</label>
            <div class="col-sm-12">
                  <input type="email" class="form-control select2-offscreen" value="{{Auth::user()->email}}" id="from" name="from" placeholder="Type email" tabindex="-1">
            </div>
      </div>

            <div class="form-group">
                  <label for="to" class="col-sm-1 control-label">To:</label>

                  <div class="row justify-content-sm-center">
                       
                        <div class="col-sm-7">
                              <input type="email" class="form-control select2-offscreen" id="to" name="to" placeholder="Type email" tabindex="-1">
                        </div>
                        <div class="col-sm-4">
                              <select class="form-control input" name="to_sel" id="to_sel" >
                                    <option selected disabled>Please select a Client</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}" email="{{$user->email}}">{{$user->name}}</option>
                                    @endforeach
                              </select>
                        </div>
                  </div>
                  
            </div>
      <div class="form-group">
            <label for="cc" class="col-sm-1 control-label">Cc:</label>
            <div class="row justify-content-sm-center">
                  <div class="col-sm-7">
                        <input type="email" class="form-control select2-offscreen" id="cc" name="cc" placeholder="Type email" tabindex="-1">
                  </div>
                  <div class="col-sm-4">
                        <select class="form-control input" name="cc_sel" id="cc_sel" >
                              <option selected disabled>Please select a Client</option>
                              @foreach($users as $user)
                              <option value="{{$user->id}}" email="{{$user->email}}">{{$user->name}}</option>
                              @endforeach
                        </select>
                  </div>
            </div>
      </div>
      
      <div class="form-group">
            <label for="cc" class="col-sm-1 control-label">Subject:</label>
            <div class="row justify-content-sm-center">
                  <div class="col-sm-7">
                        <input type="text" class="form-control select2-offscreen" id="subject" name="subject" placeholder="Subject" tabindex="-1">
                  </div> 
                  <div class="col-sm-4">
                        <select class="form-control input" name="subject_sel" id="subject_sel" >
                              <option selected disabled>Please select a Service</option>
                              @foreach($services as $service)
                              <option value="{{$service->id}}" subject="{{$service->s_name}}">{{$service->s_name}}</option>
                              @endforeach
                        </select>
                  </div>                
            </div>
      </div>
      {{-- <div class="form-group">
            <label for="bcc" class="col-sm-1 control-label">BCC:</label>
            <div class="col-sm-11">
                  <input type="email" class="form-control select2-offscreen" id="bcc" placeholder="Type email" tabindex="-1">
            </div>
      </div> --}}
      <div class="form-group">
            
            <div class="col-sm-12">
                  <textarea class="form-control" id="message" name="body" rows="12" placeholder="Message"></textarea>
                  <input type="file" name="files[]" multiple>
            </div>
      </div>
      <div class="form-group">
            
            <div class="col-sm-11">
                  <input type="submit" value="Send Email" class="btn btn-danger">
            </div>
      </div>

          
      
    </form>
    
</div>	
    
@endsection
@section('endscript')
      <script>
            $(document).on('change','#to_sel',function(){

                  var val=$(this).children("option:selected").attr('email');
                  // console.log(val);
                  $('#to').val(val);

            });
            
            $(document).on('change','#cc_sel',function(){

                  var val=$(this).children("option:selected").attr('email');
                  // console.log(val);
                  $('#cc').val(val);

            });
            
            $(document).on('change','#subject_sel',function(){

                  var val=$(this).children("option:selected").attr('subject');
                  var txt="This Email is Regarding with "+val;
                  // console.log(val);
                  $('#subject').val(txt);

            });
            
      </script>
    
@endsection