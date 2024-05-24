<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    use HasFactory;
    protected $fillable = [
        'hub_address',
    ];

    public function product() {
        return $this->hasMany(Product::class);
    }
}
