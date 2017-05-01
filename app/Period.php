<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'elearning.periode';

    public function courses()
    {
        return $this->hasMany('App\Course','periode_id');
    }
}
