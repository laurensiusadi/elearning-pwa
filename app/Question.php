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
        return $this->hasMany('App\Quiz', 'quiz_id');
    }

    public function quiz()
    {
        return $this->belongsToMany('App\Quiz', 'quiz_id');
    }
}
