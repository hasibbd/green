<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointWallet extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function user_info()
    {
        return $this->hasOne(UserInformation::class, 'user_id','user_id');
    }
}
