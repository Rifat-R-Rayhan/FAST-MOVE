<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pickupman extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'pickupman_name',
        'phone',
        'alt_phone',
        'email',
        'password',
        'full_address',
        'police_station',
        'district',
        'division',
        'nid_front',
        'nid_back',
        'profile_img',
        'phone_number',
        'disputant_name',
        'details',
        'fast_move_parcel_id',
        'user_id',
        'verification_token',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function frauds()
    {
        return $this->hasMany(Fraud::class);
    }
}
