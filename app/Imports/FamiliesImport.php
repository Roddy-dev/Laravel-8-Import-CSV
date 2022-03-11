<?php

namespace App\Imports;

use App\Models\Familie;
use Maatwebsite\Excel\Concerns\ToModel;

class FamiliesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Familie([
            //
        ]);
    }
}
