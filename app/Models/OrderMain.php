<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMain extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function details () {
        return $this->hasMany(OrderDetail::class, 'order_main_id', 'id');
    }
    public function product_details()
    {
        return $this->hasOne(Product::class, 'id', 'vendor_product');
    }
    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
}
