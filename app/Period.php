<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'elearningnew.period';

    public function classrooms()
    {
        return $this->hasMany('App\Classroom','period_id');
    }
}
