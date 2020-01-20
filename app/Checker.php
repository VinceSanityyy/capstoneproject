<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Checker extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'schedule_id','user_id','remarks_id','status',
    ];
}
