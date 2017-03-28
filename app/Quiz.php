<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'elearning.tugas';

    public function enroll()
    {
    	return $this->belongsTo('App\Enrollment');
    }

	public function answers()
    {
    	return $this->hasMany('App\Answer', 'tugas_id');
    }
}
