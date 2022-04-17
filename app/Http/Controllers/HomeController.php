<?php

namespace App\Http\Controllers;

use App\Exports\VendorExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard', [
            'vendors' => User::all()
        ]);
    }

    public function exportAll(Request $request)
    {
        switch ($request->get('fileType')) {
            case 'csv':
                return (new VendorExport())->download('data-driver.csv', Excel::CSV, [
                    'Content-Type' => 'text/csv'
                ]);
            default:
                return back();
        }
    }
}
