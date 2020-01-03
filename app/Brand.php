<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'user_parent_id', 'name', 'code_name', 'description', 'image', 'active'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
