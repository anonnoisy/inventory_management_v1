<?php

namespace App\Model;

use App\Repositories\Product\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = [
        'user_parent_id', 'category_id', 'name', 'code_name', 'description', 'image', 'active'
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_parent_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }

}
