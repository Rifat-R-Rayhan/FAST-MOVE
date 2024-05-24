<?php

namespace App\Exports;

use App\Models\Pickupman;
use Maatwebsite\Excel\Concerns\FromCollection;

class PickupmaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Pickupman::all();

        $pickupman = Pickupman::select('pickupman_name',
        'phone',
        'alt_phone',
        'email',
        'full_address',
        'police_station',
        'district',
        'division',)->get();

        return $pickupman;
    }
}
