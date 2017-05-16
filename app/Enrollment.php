<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'elearningnew.enrollment';

    public function classroom()
    {
        return $this->belongsTo('App\Classroom', 'classroom_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
