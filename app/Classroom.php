<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enrollment;
use Auth;

class Classroom extends Model
{
    protected $table = 'elearningnew.classroom';

    public function enrollmentId($classroom)
    {
        return Enrollment::where('classroom_id',$classroom->id)->where('user_id', Auth::id())->first()->id;
    }

    public function enrolls()
    {
        return $this->hasMany('App\Enrollment', 'classroom_id');
    }

    public function period()
    {
        return $this->belongsTo('App\Period','period_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject','subject_id');
    }

    public function quizes()
    {
        return $this->hasMany('App\Quiz', 'classroom_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'classroom_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'elearningnew.enrollment', 'classroom_id', 'user_id')->withTimestamps();
    }
}
