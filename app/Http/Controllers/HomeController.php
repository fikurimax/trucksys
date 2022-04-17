<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteCsvFileAfterDownload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        $vendors = User::all();
        $filename = "data-vendor-" . time() . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Nama Perusahaan', 'Email', 'No. Telepon', 'Nama Pemilik', 'NPWP', 'Alamat'));

        foreach ($vendors as $vendor) {
            fputcsv($handle, array($vendor['name'], $vendor['email'], $vendor['phone_number'], $vendor['owner_name'], $vendor['npwp'], $vendor['address']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, "data-vendor.csv", $headers);
    }
}
