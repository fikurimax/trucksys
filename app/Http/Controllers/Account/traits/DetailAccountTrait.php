<?php

namespace App\Http\Controllers\Account\traits;

use Illuminate\Http\Request;

/**
 * Account detail
 */
trait DetailAccountTrait
{
    public function detail(Request $request)
    {
        if (auth()->user()->is_updated) {
            $viewTemplate = 'pages.account.detail';
        } else {
            $viewTemplate = 'pages.account.update';
        }

        return view($viewTemplate, [
            'account' => auth()->user()
        ]);
    }
}
