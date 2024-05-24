<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();

        // $product = Product::select('product_category',
        // 'customer_name',
        // 'customer_phone',
        // 'full_address',
        // 'divisions',
        // 'district',
        // 'police_station',
        // 'order_tracking_id',
        // 'delivery_type',
        // 'cod_amount',
        // 'invoice',
        // 'note',
        // 'product_weight',
        // 'exchange_status',
        // 'delivery_charge',
        // 'user_id',
        // 'deliveryman_id',
        // 'pickupman_id')->get();

        // return $product;
    }
}
