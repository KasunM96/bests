<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable=
    [
    'name',
    'address',
    'tp',
    'email',
    'idfrommain'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

