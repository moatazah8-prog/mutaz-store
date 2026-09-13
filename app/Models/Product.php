<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'category',
        'price',
        'cost_price',
        'currency',
        'stock',
        'featured',
    ];
}
