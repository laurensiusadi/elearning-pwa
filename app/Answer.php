<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'elearningnew.answer';

	public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function quiz()
    {
    	return $this->belongsTo('App\Quiz', 'quiz_id');
    }
}
