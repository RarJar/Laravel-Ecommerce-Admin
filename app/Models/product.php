<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'original_price',
        'discount_price',
        'category',
        'availability',
        'description',
        'product_token'
    ];
}
