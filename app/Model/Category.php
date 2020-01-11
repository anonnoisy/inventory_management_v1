<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{

    protected $fillable = [
        'user_parent_id', 'name', 'code_name', 'active' 
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_parent_id');
    }

    public function brands()
    {
        return $this->hasMany('App\Model\Brand');
    }

}
