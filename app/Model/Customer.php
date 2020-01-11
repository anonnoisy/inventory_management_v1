<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_parent_id', 'firstname', 'lastname', 'address', 'number_id', 'postcode', 'phone', 'email', 'image', 'active'
    ];

    /**
     * This function for realtionship with user
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
