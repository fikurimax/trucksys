<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Service\Vendor\VendorBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.vendors.index', [
            'vendors'   => Vendor::get()
        ]);
    }

    public function register(Request $request)
    {
        return view('pages.vendors.register');
    }

    public function update(Request $request)
    {
        if ($request->isNotFilled('vid')) {
            return redirect()->back();
        }

        $vendor = Vendor::find($request->get('vid'));
        if ($vendor == null) {
            return redirect()->back();
        }

        return view('pages.vendors.register', [
            'vendor'    => $vendor
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'id'                => 'numeric',
            'nama_perusahaan'   => 'required|string',
            'nama_pemilik'      => 'required|string',
            'alamat'            => 'required',
            'kontak'            => 'required|numeric|digits_between:11,15',
            'npwp'              => 'required|min:15|max:20'
        ], [
            'nama_perusahaan.required' => 'Silakan isi kolom Nama',
            'pemilik.required'      => 'Silakan isi kolom Nama',
            'alamat.required'       => 'Silakan isi kolom Alamat',
            'kontak.required'       => 'Silakan isi kolom Kontak',
            'npwp.required'         => 'Silakan isi kolom NPWP',
            'numeric'               => 'Silakan isi data dengan benar',
            'kontak.digits_between' => 'Digit nomor handphone antara 11 - 15',
            'npwp.min'              => 'Minimum jumlah digit NPWP adalah 15',
            'npwp.min'              => 'Maximum jumlah digit NPWP adalah 20'
        ]);

        if ($request->filled('id')) {
            // Update driver
            try {
                Vendor::find($request->post('id'))
                    ->update($request->except(['_token']));
            } catch (\Throwable $th) {
                Log::critical($th->getMessage());
                Log::critical($th->getTraceAsString());

                return redirect()
                    ->route('vendor.register')
                    ->withInput()
                    ->withErrors(['Terjadi gangguan pada server']);
            }

            Log::info(Auth::id() . " mengubah data vendor " . $request->post('nama_perusahaan'));
        } else {
            // Register driver
            try {
                Vendor::create($request->except(['_token']));
            } catch (\Throwable $th) {
                Log::critical($th->getMessage());
                Log::critical($th->getTraceAsString());

                return redirect()
                    ->route('vendor.register')
                    ->withInput()
                    ->withErrors(['Terjadi gangguan pada server']);
            }

            Log::info(Auth::id() . " menambahkan vendor  baru " . $request->post('nama_perusahaan'));
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

        $ok = Vendor::find($request->get('id'))->delete();
        if (!$ok) {
            return back();
        }

        return redirect()->route('vendor.index');
    }
}
