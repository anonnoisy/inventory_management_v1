<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'user_parent_id', 'vendor_name', 'email', 'phone', 'mobile', 'address', 'description', 'image', 'active'
    ];

    public function users() {
        return $this->belongsTo('App\User', 'user_parent_id');
    }
}
