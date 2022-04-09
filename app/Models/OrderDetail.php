<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product_details()
    {
        return $this->hasOne(Product::class, 'id', 'vendor_product');
    }
    public function vendor_details()
    {
        return $this->hasOne(VendorProduct::class, 'id', 'vendor_product');
    }
}
