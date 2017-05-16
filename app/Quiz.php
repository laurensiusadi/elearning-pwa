<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'elearningnew.quiz';

    public function classroom()
    {
    	return $this->belongsTo('App\Classroom', 'classroom_id');
    }

	public function questions()
    {
    	return $this->hasMany('App\Question', 'question_id');
    }
}
