<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_category' => $row[0],
            'customer_name' => $row[1],
            'customer_phone' => $row[2],
            'full_address' => $row[3],
            'divisions' => $row[4],
            'district' => $row[5],
            'police_station' => $row[6],
            'order_tracking_id' => $row[7],
            'delivery_type' => $row[8],
            'cod_amount' => $row[9],
            'invoice' => $row[10],
            'note' => $row[11],
            'product_weight' => $row[12],
            'exchange_status' => $row[13],
            'delivery_charge' => $row[14],
            'user_id' => $row[15],
            'deliveryman_id' => $row[16],
            'pickupman_id' => $row[17],
        ]);
    }
}
