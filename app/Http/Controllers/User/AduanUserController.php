<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan;

class AduanUserController extends Controller
{
    public function index()
    {
        $aduans = Aduan::where('user_id', auth()->id())->latest()->get();
        return view('user.pengaduan.index', compact('aduans'));
    }

    // method lainnya...
}
