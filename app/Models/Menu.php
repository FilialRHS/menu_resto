<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'image',
        'category_id', 'is_promo', 'promo_price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}