<?php

namespace App\Exports;

use App\Models\Truck;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TruckExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('exports.truck', [
            'trucks' => Truck::all()
        ]);
    }
}
