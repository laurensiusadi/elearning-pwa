<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'elearning.enrollment';

    public function quizes()
    {
    	return $this->hasMany('App\Quiz', 'enroll_id');
    }

	public function answers()
    {
    	return $this->hasMany('App\Answer', 'enroll_id');
    }
}
