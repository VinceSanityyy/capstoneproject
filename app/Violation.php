<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Violation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'violation_details'
    ];
}
