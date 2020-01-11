<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_roles', 'user_parent_id', 'firstname', 'lastname', 'email', 'password', 'country', 'province', 'city', 'postalcode', 'active'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'user_roles' => 1
    ];

    public function user_roles() {
        return $this->belongsTo('App\Model\UserRole');
    }

    public function vendors() {
        return $this->hasMany('App\Model\Vendor');
    }

    public function brands() {
        return $this->hasMany('App\Model\Brand');
    }

    public function categories() {
        return $this->hasMany('App\Model\Category');
    }

    public function items() {
        return $this->hasMany('App\Model\Item');
    }

    public function customers() {
        return $this->hasMany('App\Model\Customer');
    }


}
