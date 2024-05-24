<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraud extends Model
{
    use HasFactory;
    protected $fillable = ['phone_number', 'disputant_name', 'details', 'steadfast_parcel_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryman()
    {
        return $this->belongsTo(Deliveryman::class);
    }

    public function pickupman()
    {
        return $this->belongsTo(Pickupman::class);
    }
}
