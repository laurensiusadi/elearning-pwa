<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kodeine\Acl\Traits\HasRole;
use Kodeine\Acl\Models\Eloquent\Role as Role;

class User extends Authenticatable
{
    use Notifiable;
    use HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Users can belong to many roles.
     *
     * @return Model
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany('App\Classroom', 'elearningnew.enrollment', 'user_id', 'classroom_id')->withTimestamps();
    }
}
