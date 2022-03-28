<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Service\Truck\TruckBusinessService;
use App\Service\Vendor\VendorBusinessService;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    private TruckBusinessService $truck_service;
    private VendorBusinessService $vendor_service;

    public function __construct()
    {
        $this->truck_service = TruckBusinessService::getInstance();
        $this->vendor_service = VendorBusinessService::getInstance();
    }

    public function index(Request $request)
    {
        return view('pages.trucks.index', [
            'trucks'    => $this->truck_service->Get(),
            'vendor'    => $this->vendor_service->GetDetail($request->get('vid'))
        ]);
    }

    public function register(Request $request)
    {
        return view('pages.trucks.register', [
            'vendor'    => $this->vendor_service->GetDetail($request->get('vid'))
        ]);
    }

    public function update(Request $request)
    {
        $vendor = $this->truck_service->GetDetail((int) $request->get('id'));

        return view('pages.trucks.register', [
            'vendor'    => $vendor
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'id'                => 'numeric',
            'plate_number'      => 'required|string',
            'year_made'         => 'required|numeric',
            'weight_empty'      => 'required|string',
            'type'              => 'required|string',
            'id_vendor'         => 'required|numeric'
        ], [
            'plate_number.required'         => 'Silakan isi kolom Nama',
            'year_made.required'            => 'Silakan isi kolom Alamat',
            'weight_empty.required'         => 'Silakan isi kolom Kontak',
            'type.required'                 => 'Silakan isi kolom NPWP',
            'numeric'                       => 'Silakan isi data dengan benar',
            'weight_empty.digits_between'   => 'Digit nomor handphone antara 11 - 15'
        ]);

        if ($request->filled('id')) {
            // Update driver
            $success = $this->truck_service->Update(
                $request->post('id'),
                $request->post('plate_number'),
                $request->post('year_made'),
                $request->post('weight_empty'),
                $request->post('type'),
                $request->post('id_vendor')
            );
        } else {
            // Register driver
            $success = $this->truck_service->Register(
                $request->post('plate_number'),
                $request->post('year_made'),
                $request->post('weight_empty'),
                $request->post('type'),
                $request->post('id_vendor'),
                $request->post('id_driver')
            );
        }

        if (!$success) {
            return redirect()->route('truck.register')->withErrors('Terjadi gangguan pada server');
        }

        if ($request->has('add_another')) {
            return redirect()->route('truck.register')->withInput(
                $request->only('add_another')
            );
        }

        return redirect()->route('truck.index');
    }

    public function delete(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('truck.index');
        }

        $ok = $this->truck_service->Delete($request->get('id'));
        if (!$ok) {
            return back()->withErrors('Terjadi gangguan pada server');
        }

        return redirect()->route('truck.index');
    }
}
