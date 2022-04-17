<?php

namespace App\Http\Controllers\Truck;

use App\Exports\TruckExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTruckRequest;
use App\Models\Truck;
use App\Models\TruckPhotos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class TruckController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.trucks.index', [
            'vendor'    => Auth::user(),
            'vehicles'  => Truck::where('id_vendor', Auth::id())->orderBy('id', 'desc')->get()
        ]);
    }

    public function exportAll(Request $request)
    {
        switch ($request->get('fileType')) {
            case 'csv':
                return (new TruckExport())->download('data-driver.csv', Excel::CSV, [
                    'Content-Type' => 'text/csv'
                ]);
            default:
                return back();
        }
    }

    public function detail(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return back()->withErrors([
                'ID kendaraan tidak dikenali'
            ]);
        }

        $vehicle = Truck::find($request->get('id'));
        if ($vehicle == null) {
            return redirect()->route('vehicle.index');
        }

        return view('pages.trucks.detail', [
            'vendor'    => Auth::user(),
            'vehicle'   => $vehicle
        ]);
    }

    public function register(Request $request)
    {
        return view('pages.trucks.register');
    }

    public function update(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return back();
        }

        $vehicle = Truck::find($request->get('id'));
        if ($vehicle == null) {
            return back();
        }

        return view('pages.trucks.register', [
            'vehicle'   => $vehicle
        ]);
    }

    public function save(RegisterTruckRequest $request)
    {
        $request->merge([
            'masa_berlaku_pajak_kendaraan' => Carbon::parse(str_replace('/', '-', $request->post('masa_berlaku_pajak_kendaraan')))->format('Y-m-d'),
            'masa_berlaku_stnk' => Carbon::parse(str_replace('/', '-', $request->post('masa_berlaku_stnk')))->format('Y-m-d'),
            'masa_berlaku_kir' => Carbon::parse(str_replace('/', '-', $request->post('masa_berlaku_kir')))->format('Y-m-d'),
        ]);

        if ($request->filled('id')) {
            if (!empty($request->file('photos'))) {
                $filenames = [];
                $i = 0;
                foreach ($request->file('photos') as $key => $value) {
                    $filenames[$i] = uniqid($key) . "." . $value->getClientOriginalExtension();

                    $value->storeAs('public' . DIRECTORY_SEPARATOR . 'trucks', $filenames[$i]);
                    $i++;
                }
            }

            DB::beginTransaction();
            try {
                $request->request->add([
                    'updated_at' => Carbon::now()
                ]);

                $truck = Truck::find($request->post('id'));
                $truck->update($request->except([
                    'add_another',
                    'id',
                    '_token',
                    'descriptions',
                    'photos'
                ]));

                if (!empty($request->file('photos'))) {
                    for ($i = 0; $i < count($filenames); $i++) {
                        $photo = TruckPhotos::firstWhere([
                            'description' => $request->post('descriptions')[$i],
                            'id_truck' => $truck->id
                        ]);
                        $lastFilename = $photo->filename;
                        $photo->filename = $filenames[$i];
                        $photo->save();

                        @Storage::delete('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $lastFilename);
                    }
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                if (!empty($request->file('photos'))) {
                    foreach ($filenames as $filename) {
                        if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $filename)) {
                            Storage::delete('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $filename);
                        }
                    }
                }

                Log::critical($th->getMessage());
                Log::critical($th->getTraceAsString());

                return redirect()
                    ->route('vehicle.register', ['vid' => $request->post('id_vendor')])
                    ->withErrors([
                        'Terjadi gangguan pada server'
                    ])
                    ->withInput();
            }
        } else {
            $filenames = [];
            for ($i = 0; $i < count($request->file('photos')); $i++) {
                $filenames[$i] = uniqid("$i") . "." . $request->file('photos')[$i]->getClientOriginalExtension();

                $request->file('photos')[$i]->storeAs('public' . DIRECTORY_SEPARATOR . 'trucks', $filenames[$i]);
            }

            DB::beginTransaction();
            try {
                $request->request->add([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'id_vendor'  => Auth::id()
                ]);

                // Create vehicle
                $id_truck = Truck::insertGetId($request->except([
                    'add_another',
                    '_token',
                    'descriptions',
                    'photos'
                ]));

                for ($i = 0; $i < count($filenames); $i++) {
                    TruckPhotos::create([
                        'id_truck' => $id_truck,
                        'description' => $request->post('descriptions')[$i],
                        'filename' => $filenames[$i]
                    ]);
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                foreach ($filenames as $filename) {
                    if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $filename)) {
                        Storage::delete('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $filename);
                    }
                }

                Log::critical($th->getMessage());
                Log::critical($th->getTraceAsString());

                return redirect()
                    ->route('vehicle.register', ['vid' => $request->post('id_vendor')])
                    ->withErrors([
                        'Terjadi gangguan pada server'
                    ])
                    ->withInput();
            }
        }

        if ($request->has('add_another')) {
            return redirect()->route('vehicle.register', ['vid' => $request->post('id_vendor')])
                ->withInput(
                    $request->only('add_another')
                );
        }

        return redirect()->route('vehicle.index', ['vid' => $request->post('id_vendor')]);
    }

    public function delete(Request $request)
    {
        if ($request->isNotFilled('id')) {
            return redirect()->route('vehicle.index');
        }

        $ok = Truck::find($request->get('id'))->delete();
        if (!$ok) {
            return back()->withErrors(['Terjadi gangguan pada server']);
        }

        return redirect()->route('vehicle.index');
    }
}
