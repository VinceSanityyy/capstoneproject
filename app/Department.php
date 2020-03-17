<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'department_id';
    protected $fillable = [
        'department_name','department_code','department_id'
    ];
}
