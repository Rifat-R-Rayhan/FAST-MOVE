<?php

namespace App\Exports;

use App\Models\Deliveryman;
use Maatwebsite\Excel\Concerns\FromCollection;

class DeliverymanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Deliveryman::all();

        $deliveryman = Deliveryman::select('deliveryman_name',
        'phone',
        'alt_phone',
        'email',
        'full_address',
        'police_station',
        'district',
        'division',)->get();

        return $deliveryman;
    }
}
