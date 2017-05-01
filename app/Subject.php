<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'elearning.matakuliah';

    public function courses()
    {
        return $this->hasMany('App\Course','mk_id');
    }
}
