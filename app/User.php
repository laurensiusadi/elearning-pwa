<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kodeine\Acl\Traits\HasRole;

class User extends Authenticatable
{
    use Notifiable;
    
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
        return $this->belongsToMany('Kodeine\Acl\Models\Eloquent\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
}
