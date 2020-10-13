<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckerDetails extends Model
{
    protected $fillable = [
        'round_id','violation_id'
    ];
}
