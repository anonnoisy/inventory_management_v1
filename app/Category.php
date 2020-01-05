<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{

    protected $fillable = [
        'user_parent_id', 'name', 'code_name', 'active' 
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

}
