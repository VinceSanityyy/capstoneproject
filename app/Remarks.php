<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remarks extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['remarks_desc'];
}
