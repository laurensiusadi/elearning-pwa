<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'elearning.kursus';

    public function enrolls()
    {
        return $this->hasMany('App\Enrollment', 'kursus_id');
    }

    public function period()
    {
        return $this->belongsTo('App\Period','periode_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject','mk_id');
    }
}
