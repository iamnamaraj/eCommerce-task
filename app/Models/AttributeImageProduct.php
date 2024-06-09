<?php

namespace App\Models;

use App\Models\AttributeProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeImageProduct extends Model
{
    use HasFactory;
    protected $fillable = ['attribute_product_id', 'image'];

    public function attributeProduct()
    {
        return $this->belongsTo(AttributeProduct::class);
    }
}
