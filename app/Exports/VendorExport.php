<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class VendorExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('exports.vendor', [
            'vendors' => User::all()
        ]);
    }
}
