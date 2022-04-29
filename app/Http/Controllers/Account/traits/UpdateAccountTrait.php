<?php

namespace App\Http\Controllers\Account\traits;

use App\Models\User;
use App\Models\VendorDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Updating account data
 */
trait UpdateAccountTrait
{
    public function edit(Request $request)
    {
        if ($request->has('id') && Gate::allows('superadmin')) {
            $data = User::find($request->query('id'));
            if ($data == null) {
                abort(404);
            }
        } else {
            $data = auth()->user();
        }

        return view('pages.account.update', [
            'account'   => $data
        ]);
    }

    public function save(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'owner_name' => 'required',
            'npwp' => 'required',
            'address' => 'required',
        ], [
            'required' => 'Silakan lengkapi formulir yang tersedia'
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }

        if ($request->has('documents')) {
            $documents = $request->file('documents');
            sort($documents);

            $filenames = [];
            for ($i = 0; $i < count($documents); $i++) {
                $filenames[$i] = uniqid($i) . "." . $documents[$i]->getClientOriginalExtension();
            }
        }

        DB::beginTransaction();
        try {
            User::find($request->post('id'))
                ->update([
                    'name' => $request->post('name'),
                    'phone_number' => $request->post('phone_number'),
                    'owner_name' => $request->post('owner_name'),
                    'npwp' => $request->post('npwp'),
                    'address' => $request->post('address'),
                    'is_updated' => 1
                ]);

            if ($request->has('documents')) {
                for ($i = 0; $i < count($filenames); $i++) {
                    VendorDocument::updateOrInsert([
                        'id_vendor' => $request->post('id'),
                        'description' => $request->post('descriptions')[$i]
                    ], [
                        'filename' => $filenames[$i]
                    ]);

                    $documents[$i]
                        ->storeAs('public' . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . Str::kebab(strtolower($request->post('descriptions')[$i])), $filenames[$i]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage());

            if ($request->has('documents')) {
                for ($i = 0; $i < count($filenames); $i++) {
                    if (Storage::exists('public' . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . Str::kebab(strtolower($request->post('descriptions')[$i])) . DIRECTORY_SEPARATOR . $filenames[$i])) {
                        Storage::delete('public' . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . Str::kebab(strtolower($request->post('descriptions')[$i])) . DIRECTORY_SEPARATOR . $filenames[$i]);
                    }
                }
            }

            return back()->withErrors(['Terjadi kesalahan pada server'])->withInput();
        }

        if ($request->has('id')) {
            return redirect()->route('account.detail', ['id' => $request->post('id')]);
        } else {
            return redirect()->route('account.detail');
        }
    }
}
