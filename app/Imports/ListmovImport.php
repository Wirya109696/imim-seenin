<?php

namespace App\Imports;

use App\Models\Listmov;
use Maatwebsite\Excel\Concerns\ToModel;

class ListmovImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Listmov([
            "user_id"=> $row[0],
            "title"=> $row[1],
            "slug"=> $row[2],
            "category_id"=> $row[3],
            "excerpt"=> $row[4],
            "body"=> $row[5],
        ]);
    }
}
