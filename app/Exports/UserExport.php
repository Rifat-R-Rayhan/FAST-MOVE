<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();

        $merchant = User::select(
            'business_name',
            'merchant_name',
            'pick_up_location',
            'phone',
            'email',
        )->get();

        return $merchant;
    }
}
