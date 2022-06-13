<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderMain::class, 'created_by', 'user_id');
    }
    public function last_shop(){
        return $this->hasOne(OrderMain::class, 'created_by', 'user_id')->latest();
    }
    public function point(){
        return $this->hasMany(PointWallet::class,  'user_id','user_id');
    }
    public function reserve(){
        return $this->hasMany(UserReserve::class, 'user_id', 'user_id')->where('status', CONST_STATUS_ENABLED);
    }
    public function balance(){
        return $this->hasMany(UserBalanceWallat::class, 'user_id', 'user_id')->where('status', CONST_STATUS_ENABLED);
    }
}
