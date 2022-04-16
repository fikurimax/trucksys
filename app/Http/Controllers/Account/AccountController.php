<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Account\traits\DetailAccountTrait;
use App\Http\Controllers\Account\traits\UpdateAccountTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    use DetailAccountTrait, UpdateAccountTrait;
}
