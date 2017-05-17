<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'elearningnew.question';

    public function answers()
    {
        return $this->hasMany('App\Answer', 'question_id');
    }

    public function keys()
    {
        return $this->hasMany('App\Key', 'question_id');
    }

    public function quizes()
    {
        return $this->belongsToMany('App\Quiz', 'quiz_question', 'question_id', 'quiz_id');
    }
}
