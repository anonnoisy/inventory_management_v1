<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
        'role_name', 'role_permission'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }
}
