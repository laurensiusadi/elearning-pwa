<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'elearning.pengumpulan';

	public function enroll()
    {
    	return $this->belongsTo('App\Enrollment', 'enroll_id');
    }

    public function quiz()
    {
    	return $this->belongsTo('App\Quiz', 'tugas_id');
    }

    public function details()
    {
    	return $this->hasMany('App\Detail', 'kumpul_id');
    }
}
