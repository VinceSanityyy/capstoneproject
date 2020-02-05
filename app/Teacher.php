<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Teacher extends Model
{

  use SoftDeletes;
    protected $fillable =[
      'id','fullname','image','course','contact','id_number',
    ];

    // public function subjects(){
    //   return $this->hasMany('App/Subject');
    // }

    // public function schedules(){
    //   return $this->hasMany('App/Schedule');
    // }
}
