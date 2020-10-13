<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Schedule extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'subject_code_id',
        'teacher_id',
        'room_id',
        'start_time',
        'end_time',
        'school_year',
        'semester',
        'term',
        'day',
        'student_id',
    ];
}
