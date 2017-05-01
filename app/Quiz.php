<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'elearning.tugas';

    public function enrollment()
    {
    	return $this->belongsTo('App\Enrollment', 'enroll_id');
    }

	public function answers()
    {
    	return $this->hasMany('App\Answer', 'tugas_id');
    }
}
