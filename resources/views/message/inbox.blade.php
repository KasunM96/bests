 @extends('layouts.message')
 @section('messages')
 INBOX
 <div class="panel-body">
    
     <ul class="messages-list">
         @foreach ($messages as $message)

         <li class="unread">
            <a href="#modal" id="modallink" data-target="#modal" data-toggle="modal" data-person="{{$message->from}}" data-id="{{$message->id}}" 
                data-subject="{{$message->subject}}" data-body="{{$message->message}}" data-box="From">

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
     
 @endsection
