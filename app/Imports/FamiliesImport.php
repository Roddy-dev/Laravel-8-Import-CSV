<?php

namespace App\Imports;

use App\Models\Familie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

class FamiliesImport implements
    ToModel
// , WithUpserts
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

    public function uniqueBy()
    {
        return 'id';
    }
}
