INBOX
<div class="panel-body">
   
    <ul class="messages-list">
        @foreach ($messages as $message)

        <li class="unread">
            <a href="page-inbox-message.html">
                <div class="header">
                    <span class="action"><i class="fa fa-square-o"></i><i class="fa fa-square"></i></span> 
                    <span class="from">{{$message->to}}</span>
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