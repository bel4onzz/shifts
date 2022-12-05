<?php

namespace App\Imports;

use App\Models\Shift;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShiftsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd("ROW[0] => ", $row['date']);
        $insert_records = new Shift([
            'date' => $row['date'],
            'employee' => $row['employee'],
            'employer' => $row['employer'],
            'hours' => $row['hours'],
            'rate_per_hours' => $row['rate_per_hour'],
            'shift_type' => $row['shift_type'],
            'taxable' => $row['taxable'],
            'status' => $row['status'],
            'paid_at' => $row['paid_at'],
        ]);
        return $insert_records;
    }
}
