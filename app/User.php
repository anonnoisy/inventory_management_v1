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

    public function user_roles() {
        return $this->belongsTo('App\UserRole');
    }

    public function brands() {
        return $this->hasMany(Brand::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function customers() {
        return $this->hasMany(Customer::class);
    }


}
