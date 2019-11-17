<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable =[
      'firstname','lastname','gender','birthday','age','type','department_id',
      'type','status','image',
    ];

    public function subjects(){
      return $this->hasMany('App/Subject');
    }

    public function schedules(){
      return $this->hasMany('App/Schedule');
    }
}
