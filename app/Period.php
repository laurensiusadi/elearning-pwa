<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'elearningnew.period';

    public function classroom()
    {
        return $this->hasMany('App\Classroom','period_id');
    }
}
