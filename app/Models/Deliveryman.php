<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryman extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliveryman_name',
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
        'steadfast_parcel_id',
        'user_id',
        'verification_token',
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
    public function frauds()
    {
        return $this->hasMany(Fraud::class);
    }
}
