<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;

class CarExport implements FromCollection
{
    public function collection()
    {
        return Car::all();
    }
}
