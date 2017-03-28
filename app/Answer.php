<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'elearning.pengumpulan';

	public function enroll()
    {
    	return $this->belongsTo('App\Enrollment');
    }

    public function quiz()
    {
    	return $this->belongsTo('App\Quiz');
    }

    public function details()
    {
    	return $this->hasMany('App\Detail', 'kumpul_id');
    }
}
