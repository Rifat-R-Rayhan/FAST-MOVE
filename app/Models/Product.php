<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_user_name',
        'local_user_contact',
        'local_user_email',
        'local_user_address',
        'product_category',
        'customer_name',
        'customer_phone',
        'customer_email',
        'full_address',
        'divisions',
        'district',
        'police_station',
        'order_tracking_id',
        'delivery_type',
        'cod_amount',
        'invoice',
        'note',
        'product_weight',
        'exchange_status',
        'delivery_charge',
        'product_bar_code',
        'user_id',
        'hub_id',
        'deliveryman_id',
        'pickupman_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function deliveryman(){
        return $this->belongsTo(Deliveryman::class);
    }

    public function pickupman(){
        return $this->belongsTo(Pickupman::class);
    }

    public function hub() {
        return $this->belongsTo(Hub::class);
    }
}
