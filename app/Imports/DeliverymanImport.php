<?php

namespace App\Imports;

use App\Models\Deliveryman;
use Maatwebsite\Excel\Concerns\ToModel;

class DeliverymanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Deliveryman([
            'deliveryman_name'=>$row[0],
            'phone'=>$row[1],
            'alt_phone'=>$row[2],
            'email'=>$row[3],
            'password'=>'12345678',
            'full_address'=>$row[5],
            'police_station'=>$row[6],
            'district'=>$row[7],
            'division'=>$row[8],
        ]);
    }
}
