<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;

class AdminImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Admin([
            'admin_name'=>$row[0],
            'designation'=>$row[1],
            'phone'=>$row[2],
            'email'=>$row[3],
            'password'=>'12345678',
            'address'=>$row[5],
            'role'=>$row[6],
        ]);
    }
}
