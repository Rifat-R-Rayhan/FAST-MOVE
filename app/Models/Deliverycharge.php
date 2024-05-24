<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverycharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_location',
        'destination',
        'category',
        'delivery_type',
        'cost',
        'weight',
    ];
}
