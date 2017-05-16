<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'elearningnew.subject';

    public function classrooms()
    {
        return $this->hasMany('App\Classroom','subject_id');
    }
}
