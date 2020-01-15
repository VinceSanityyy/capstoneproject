<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checker extends Model
{
    protected $fillable = [
        'schedule_id','user_id','remarks_id','status',
    ];
}
