<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Round extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'checker_id',
        'round_no',
        'remarks_id',
        'status',
        'time_check',
    ];
}
