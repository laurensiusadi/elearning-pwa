<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $table = 'elearningnew.key';

    public function question()
    {
    	return $this->belongsTo('App\Question', 'question_id');
    }
}
