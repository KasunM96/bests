@extends('layouts.message')
@section('messages')
Files Viewer
<div class="panel-body">
   
    <ul class="messages-list">
       @foreach ($files as $file)
       {{$file->id}}. <a href="upload/{{$file->location}}">{{$file->location}}</a>
       <br>
           
       @endforeach

    </ul>
    
</div>	
    
@endsection