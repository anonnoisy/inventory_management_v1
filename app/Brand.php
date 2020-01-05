<?php

namespace App;

use App\Repositories\Product\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = [
        'user_parent_id', 'category_id', 'name', 'code_name', 'description', 'image', 'active'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

}
