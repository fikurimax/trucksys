<?php

namespace App\Exports;

use App\Models\Driver;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class DriverExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('exports.driver', [
            'drivers' => Driver::all()
        ]);
    }
}
