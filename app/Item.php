<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_parent_id', 'category_id', 'brand_id', 'name', 'code_name', 'description', 'price', 'quantity', 'image', 'active'
    ];

    /**
     * This function relationship belongs to user
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This function relationship belongs to category
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * This function relationship belongs to brand
     */
    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

}
