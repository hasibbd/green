<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    public function product_details()
    {
        return $this->hasOne(Product::class, 'id', 'product');
    }
}
