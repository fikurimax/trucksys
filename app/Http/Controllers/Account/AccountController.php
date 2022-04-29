<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Account\traits\DetailAccountTrait;
use App\Http\Controllers\Account\traits\UpdateAccountTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{
    use DetailAccountTrait, UpdateAccountTrait;

    public function ViewAllAccounts(Request $request)
    {
        if (Gate::denies('superadmin')) {
            abort(404);
        }

        return view('pages.account.all', [
            'users' => User::get()
        ]);
    }

    public function ExportAllAccounts(Request $request)
    {
        $username = auth()->user()->name;

        $users = User::get();
        $filename = "data-pengguna-" . $username . "-" . date('d-m-Y') . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Nama Pengguna', 'Nama Pemilik', 'Email', 'Nomor Telepon', 'NPWP', 'Alamat', 'Terdaftar Pada'));

        foreach ($users as $user) {
            fputcsv($handle, array($user['name'], $user['owner_name'], $user['email'], $user['phone_number'], $user['npwp'], $user['address'], $user['created_at']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, "data-pengguna-" . $username . "-" . date('d-m-Y') . ".csv", $headers);
    }
}
