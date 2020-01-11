<?php

namespace App\Model;

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
        return $this->belongsTo('App\User', 'user_parent_id');
    }

    /**
     * This function relationship belongs to category
     */
    public function categories()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }

    /**
     * This function relationship belongs to brand
     */
    public function brands()
    {
        return $this->belongsTo('App\Model\Brand', 'brand_id');
    }

}
