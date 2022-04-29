<?php

namespace App\Http\Controllers\Account\traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Account detail
 */
trait DetailAccountTrait
{
    public function detail(Request $request)
    {
        if ($request->has('id') && Gate::allows('superadmin')) {
            $data = User::find($request->query('id'));
            if ($data == null) {
                abort(404);
            }
        } else {
            $data = auth()->user();
        }

        if ($data->is_updated) {
            $viewTemplate = 'pages.account.detail';
        } else {
            $viewTemplate = 'pages.account.update';
        }

        return view($viewTemplate, [
            'account' => $data
        ]);
    }
}
