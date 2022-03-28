<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Service\Vendor\VendorBusinessService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    private VendorBusinessService $vendor_service;

    public function __construct()
    {
        $this->vendor_service = VendorBusinessService::getInstance();
    }

    public function index(Request $request)
    {
        return view('pages.vendors.index', [
            'vendors'   => $this->vendor_service->Get()
        ]);
    }

    public function register(Request $request)
    {
        return view('pages.vendors.register');
    }

    public function update(Request $request)
    {
        $vendor = $this->vendor_service->GetDetail((int) $request->get('id'));

        return view('pages.vendors.register', [
            'vendor'    => $vendor
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'id'        => 'numeric',
            'name'      => 'required|string',
            'address'   => 'required',
            'contact'   => 'required|numeric|digits_between:11,15',
            'tin'       => 'required|min:15|max:20'
        ], [
            'name.required'     => 'Silakan isi kolom Nama',
            'address.required'  => 'Silakan isi kolom Alamat',
            'contact.required'  => 'Silakan isi kolom Kontak',
            'tin.required'      => 'Silakan isi kolom NPWP',
            'numeric'           => 'Silakan isi data dengan benar',
            'contact.digits_between' => 'Digit nomor handphone antara 11 - 15',
            'tin.min'           => 'Minimum jumlah digit NPWP adalah 15',
            'tin.min'           => 'Maximum jumlah digit NPWP adalah 20'
        ]);

        if ($request->filled('id')) {
            // Update driver
            $success = $this->vendor_service->Update(
                $request->post('id'),
                $request->post('name'),
                $request->post('address'),
                $request->post('contact'),
                $request->post('tin')
            );
        } else {
            // Register driver
            $success = $this->vendor_service->Register(
                $request->post('name'),
                $request->post('address'),
                $request->post('contact'),
                $request->post('tin')
            );
        }

        if (!$success) {
            return redirect()->route('vendor.register')->withErrors('Terjadi gangguan pada server');
        }

        if ($request->has('add_another')) {
            return redirect()->route('vendor.register')->withInput(
                $request->only('add_another')
            );
        }

        return redirect()->route('vendor.index');
    }

    public function delete(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('vendor.index');
        }

        $ok = $this->vendor_service->Delete($request->get('id'));
        if (!$ok) {
            return back()->withErrors('Terjadi gangguan pada server');
        }

        return redirect()->route('vendor.index');
    }
}
