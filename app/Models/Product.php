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
    public function unit_details () {
        return $this->hasOne(Unit::class, 'id', 'unit');
    }
    public function brand () {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }
    public function brand_details () {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }
    public function category () {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    public function category_details () {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    public function vendor_product () {
        return $this->hasMany(VendorProduct::class, 'product', 'id');
    }
}
