<?php

namespace App\Models;

use App\Models\Category;
use App\Models\AttributeProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributeProducts()
    {
        return $this->hasMany(AttributeProduct::class);
    }
}
