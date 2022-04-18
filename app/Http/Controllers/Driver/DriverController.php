<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteCsvFileAfterDownload;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.drivers.index', [
            'drivers' => Driver::get()
        ]);
    }

    public function exportAll(Request $request)
    {
        $username = auth()->user()->name;

        $drivers = Driver::get();
        $filename = "data-driver-" . $username . "-" . date('d-m-Y') . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('No. Reg', 'ID Driver', 'Nama Lengkap', 'Tgl. Lahir', 'Tmp. Lahir', 'Alamat', 'No. KTP', 'No. SIM', 'Masa Berlaku SIM'));

        foreach ($drivers as $driver) {
            fputcsv($handle, array($driver['nomor_registrasi'], $driver['id'], $driver['nama'], $driver['tanggal_lahir'], $driver['tempat_lahir'], $driver['alamat'], $driver['no_ktp'], $driver['no_sim'], $driver['masa_berlaku_sim']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, "data-driver-" . $username . "-" . date('d-m-Y') . ".csv", $headers);
    }

    public function detail(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return back();
        }

        $driver = Driver::find($request->get('id'));
        if ($driver == null) {
            return back();
        }

        return view('pages.drivers.detail', [
            'driver' => $driver
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
        return view('pages.drivers.register', [
            'last_id' => Driver::latest()->first()->id ?? 0,
            'last_registration_number' => $this->getTheLatesRegistrationNumber()
        ]);
    }

    public function getTheLatesRegistrationNumber(bool $lock = false)
    {
        $latestData = Driver::query();
        if ($lock) {
            $latestData->sharedLock();
        }
        $latestData = $latestData->select('nomor_registrasi')->orderBy('id', 'desc')->first();
        if ($latestData == null) {
            return '1000';
        }

        return (int) $latestData->nomor_registrasi + 1;
    }

    public function update(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('driver.index');
        }

        $driver = Driver::find((int) $request->get('id'));
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
            'nomor_registrasi'      => 'required|numeric',
            'nama'                  => 'required|string',
            'nomor_telepon'         => 'required|string',
            'alamat'                => 'required',
            'tanggal_lahir'         => 'required',
            'tempat_lahir'          => 'required',
            'no_ktp'                => 'required|numeric',
            'no_sim'                => 'required|numeric'
        ], [
            'nomor_registrasi.required' => 'Silakan isi kolom Nomor Registrasi',
            'nama.required'             => 'Silakan isi kolom Nama',
            'nomor_telepon.required'    => 'Silakan isi kolom Nomor Telepon',
            'alamat.required'           => 'Silakan isi kolom Alamat',
            'tanggal_lahir.required'    => 'Silakan isi kolom Tanggal Lahir',
            'tempat_lahir.required'     => 'Silakan isi kolom Tempat Lahir',
            'no_ktp.required'           => 'Silakan isi kolom No. KTP',
            'no_sim.required'           => 'Silakan isi kolom No. SIM',
            'numeric'                   => 'Silakan isi data dengan benar'
        ]);

        $request->merge([
            'tanggal_lahir' => Carbon::parse(str_replace('/', '-', $request->post('tanggal_lahir')))->format('Y-m-d'),
            'masa_berlaku_sim' => Carbon::parse(str_replace('/', '-', $request->post('masa_berlaku_sim')))->format('Y-m-d'),
            'nomor_registrasi' => $this->getTheLatesRegistrationNumber(true)
        ]);

        if ($request->has('profile')) {
            $profile_picture_name = uniqid() . "." . $request->file('profile')->getClientOriginalExtension();
            $request->request->add([
                'photo' => $profile_picture_name,
            ]);
        }
        if ($request->has('driver_picture_id_card')) {
            $idcard_picture = uniqid() . "." . $request->file('driver_picture_id_card')->getClientOriginalExtension();
            $request->request->add([
                'photo_ktp' => $idcard_picture,
            ]);
        }
        if ($request->has('driver_license_picture')) {
            $driver_license_picture_name = uniqid() . "." . $request->file('driver_license_picture')->getClientOriginalExtension();
            $request->request->add([
                'photo_sim' => $driver_license_picture_name
            ]);
        }

        if ($request->filled('id')) {
            // Update driver
            DB::beginTransaction();
            try {
                $driver = Driver::find($request->post('id'));
                Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . $driver);

                if ($request->has('profile')) {
                    $request->file('profile')->storeAs('public' . DIRECTORY_SEPARATOR . 'drivers', $profile_picture_name);
                }
                if ($request->has('driver_picture_id_card')) {
                    $request->file('driver_picture_id_card')->storeAs('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard', $idcard_picture);
                }
                if ($request->has('driver_license_picture')) {
                    $request->file('driver_license_picture')->storeAs('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses', $driver_license_picture_name);
                }

                Driver::find($request->post('id'))
                    ->update($request->except([
                        '_token', 'profile', 'driver_picture_id_card', 'driver_license_picture'
                    ]));

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . $profile_picture_name)) {
                    Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . $profile_picture_name);
                }

                if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard' . DIRECTORY_SEPARATOR . $idcard_picture)) {
                    Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard' . DIRECTORY_SEPARATOR . $idcard_picture);
                }

                if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses' . DIRECTORY_SEPARATOR . $driver_license_picture_name)) {
                    Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses' . DIRECTORY_SEPARATOR . $driver_license_picture_name);
                }

                Log::critical($th->getMessage());
                Log::critical($th->getTraceAsString());

                return back()
                    ->withInput()
                    ->withErrors('Terjadi gangguan pada server');
            }

            return redirect()->route('driver.detail', ['id' => $request->post('id')]);
        } else {
            // Register driver
            DB::beginTransaction();
            try {
                $request->file('profile')->storeAs('public' . DIRECTORY_SEPARATOR . 'drivers', $profile_picture_name);
                $request->file('driver_picture_id_card')->storeAs('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard', $idcard_picture);
                $request->file('driver_license_picture')->storeAs('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses', $driver_license_picture_name);

                Driver::create($request->except([
                    '_token', 'profile', 'driver_picture_id_card', 'driver_license_picture'
                ]));

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . $profile_picture_name)) {
                    Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . $profile_picture_name);
                }

                if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard' . DIRECTORY_SEPARATOR . $idcard_picture)) {
                    Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard' . DIRECTORY_SEPARATOR . $idcard_picture);
                }

                if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses' . DIRECTORY_SEPARATOR . $driver_license_picture_name)) {
                    Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses' . DIRECTORY_SEPARATOR . $driver_license_picture_name);
                }

                Log::critical($th->getMessage());
                Log::critical($th->getTraceAsString());

                return back()
                    ->withInput()
                    ->withErrors('Terjadi gangguan pada server');
            }

            return redirect()->route('driver.index');
        }
    }

    public function delete(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('driver.index');
        }

        $ok = Driver::find($request->get('id'))->delete();
        if (!$ok) {
            return redirect()->route('driver.detail', ['id' => $request->get('id')])->withErrors(['Terjadi gangguan pada server']);
        }

        return redirect()->route('driver.index');
    }
}
