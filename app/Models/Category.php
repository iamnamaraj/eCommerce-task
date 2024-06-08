<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'category_id',
    ];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
