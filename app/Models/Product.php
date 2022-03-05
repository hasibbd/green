<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function unit () {
        return $this->hasOne(Unit::class, 'id', 'unit');
    }
    public function brand () {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }
    public function category () {
        return $this->hasOne(Category::class, 'id', 'category');
    }
}
