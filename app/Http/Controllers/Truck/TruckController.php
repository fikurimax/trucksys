<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterTruckRequest;
use App\Models\Truck;
use App\Models\TruckPhotos;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    public function vendorShouldValid(Request $request)
    {
        if ($request->isNotFilled('vid')) {
            return redirect()->route('vendor.index');
        }
    }

    public function index(Request $request)
    {
        $this->vendorShouldValid($request);

        $vendor = Vendor::find($request->get('vid'));
        if ($vendor == null) {
            return redirect()->route('vendor.index');
        }

        return view('pages.trucks.index', [
            'vendor'    => $vendor,
            'vehicles'  => Truck::where('id_vendor', $request->get('vid'))->orderBy('id', 'desc')->get()
        ]);
    }

    public function detail(Request $request)
    {
        $this->vendorShouldValid($request);

        $vendor = Vendor::find($request->get('vid'));
        if ($vendor == null) {
            return redirect()->route('vendor.index');
        }

        if ($request->isNotFilled('id')) {
            return back()->withErrors([
                'ID kendaraan tidak dikenali'
            ]);
        }

        $vehicle = Truck::find($request->get('id'));
        if ($vehicle == null) {
            return redirect()->route('vehicle.index', ['vid' => $request->get('vid')]);
        }

        return view('pages.trucks.detail', [
            'vendor'    => $vendor,
            'vehicle'   => $vehicle
        ]);
    }

    public function register(Request $request)
    {
        $this->vendorShouldValid($request);

        $vendor = Vendor::find($request->get('vid'));
        if ($vendor == null) {
            return redirect()->route('vendor.index');
        }

        return view('pages.trucks.register', [
            'vendor'    => $vendor
        ]);
    }

    public function update(Request $request)
    {
        $this->vendorShouldValid($request);

        $vendor = Vendor::find($request->get('vid'));
        if ($vendor == null) {
            return redirect()->route('vendor.index');
        }

        if ($request->isNotFilled('id')) {
            return back();
        }

        $vehicle = Truck::find($request->get('id'));
        if ($vehicle == null) {
            return back();
        }

        return view('pages.trucks.register', [
            'vendor'    => $vendor,
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

                    $value->storeAs('public/trucks', $filenames[$i]);
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
                        TruckPhotos::where([
                            'description' => $request->post('descriptions')[$i],
                            'id_truck' => $truck->id
                        ])->update([
                            'filename' => $filenames[$i]
                        ]);
                    }
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                if (!empty($request->file('photos'))) {
                    foreach ($filenames as $filename) {
                        if (Storage::exists('trucks' . DIRECTORY_SEPARATOR . $filename)) {
                            Storage::delete('trucks' . DIRECTORY_SEPARATOR . $filename);
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

                $request->file('photos')[$i]->storeAs('public/trucks', $filenames[$i]);
            }

            DB::beginTransaction();
            try {
                $request->request->add([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
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
                    if (Storage::exists('trucks' . DIRECTORY_SEPARATOR . $filename)) {
                        Storage::delete('trucks' . DIRECTORY_SEPARATOR . $filename);
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

        return redirect()->route('vehicle.index');
    }

    public function delete(Request $request)
    {
        if ($request->isNotFilled('vid')) {
            return redirect()->route('vendor.index');
        }

        if ($request->isNotFilled('id')) {
            return redirect()->route('vehicle.index', ['vid' => $request->get('vid')]);
        }

        $ok = Truck::find($request->get('id'))->delete();
        if (!$ok) {
            return back()->withErrors(['Terjadi gangguan pada server']);
        }

        return redirect()->route('vehicle.index', ['vid' => $request->get('vid')]);
    }
}
