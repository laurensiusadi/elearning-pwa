<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'elearning.posting';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
