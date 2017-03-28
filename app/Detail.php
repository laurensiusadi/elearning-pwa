<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'elearning.detail';

	public function answer()
    {
    	return $this->belongsTo('App\Answer');
    }
}
