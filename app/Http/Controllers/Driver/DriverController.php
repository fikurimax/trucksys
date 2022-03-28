<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Service\Driver\DriverBusinessService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    private DriverBusinessService $driver_service;

    public function __construct()
    {
        $this->driver_service = DriverBusinessService::getInstance();
    }

    public function index(Request $request)
    {
        return view('pages.drivers.index', [
            'drivers'   => $this->driver_service->Get()
        ]);
    }

    public function find(Request $request)
    {
        if ($request->isNotFilled('searchQuery')) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Supir tidak ditemukan'
            ], 400);
        }

        $drivers = $this->driver_service->Find($request->get('searchQuery'));
        if (empty($drivers)) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Supir tidak ditemukan'
            ], 400);
        }

        return response()->json([
            'status'    => 'ok',
            'message'   => 'Supir tersedia',
            'data'      => $drivers
        ]);
    }

    public function register(Request $request)
    {
        return view('pages.drivers.register');
    }

    public function update(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('driver.index');
        }

        $driver = $this->driver_service->GetDetail((int) $request->get('id'));
        if ($driver == null) {
            return redirect()->route('driver.index');
        }

        return view('pages.drivers.register', [
            'driver'    => $driver
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'id'                    => 'numeric',
            'name'                  => 'required|string',
            'address'               => 'required',
            'contact'               => 'required|numeric',
            'identity_number'       => 'required|numeric',
            'driver_license_number' => 'required|numeric'
        ], [
            'name.required'                     => 'Silakan isi kolom Nama',
            'address.required'                  => 'Silakan isi kolom Alamat',
            'contact.required'                  => 'Silakan isi kolom Kontak',
            'identity_number.required'          => 'Silakan isi kolom No. KTP',
            'driver_license_number.required'    => 'Silakan isi kolom No. SIM',
            'numeric'                           => 'Silakan isi data dengan benar'
        ]);

        if ($request->filled('id')) {
            // Update driver
            $success = $this->driver_service->Update(
                $request->post('id'),
                $request->post('name'),
                $request->post('address'),
                $request->post('contact'),
                $request->post('identity_number'),
                $request->post('driver_license_number')
            );
        } else {
            // Register driver
            $success = $this->driver_service->Register(
                $request->post('name'),
                $request->post('address'),
                $request->post('contact'),
                $request->post('identity_number'),
                $request->post('driver_license_number')
            );
        }

        if (!$success) {
            return back()->withErrors('Terjadi gangguan pada server');
        }

        return redirect()->route('driver.index');
    }

    public function delete(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('driver.index');
        }

        $ok = $this->driver_service->Delete($request->get('id'));
        if (!$ok) {
            return back()->withErrors('Terjadi gangguan pada server');
        }

        return redirect()->route('driver.index');
    }
}
