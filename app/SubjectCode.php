<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubjectCode extends Model
{
    use SoftDeletes;
    protected $fillable = ['subject_code','subject_description'];
}
