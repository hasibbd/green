<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo',
        'user_name',
        'reffer_by',
        'phone',
        'role',
        'name',
        'email',
        'password',
        'distribution_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user_info()
    {
        return $this->hasOne(UserInformation::class, 'user_id','id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderMain::class, 'created_by', 'id');
    }
    public function last_shop(){
        return $this->hasOne(OrderMain::class, 'created_by', 'id')->latest();
    }
}
