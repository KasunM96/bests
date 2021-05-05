<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable =[
        'to','from','subject','message','s_id','files','status'

    ];
}
