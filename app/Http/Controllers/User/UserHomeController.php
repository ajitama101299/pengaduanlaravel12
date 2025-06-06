<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan;

class UserHomeController extends Controller
{
    public function index()
    {
        return view('user.home.home'); // pastikan nanti kamu punya file view ini
    }
}
