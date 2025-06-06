<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class KelolaPelaporController extends Controller
{
    public function index()
    {
        $pelaporList = User::whereHas('pengaduan')->get(); // Ambil user yang pernah buat pengaduan
        return view('admin.kelolapelapor.index', compact('pelaporList'));
    }

    public function edit($id)
    {
        $pelapor = User::findOrFail($id);
        return view('admin.kelolapelapor.edit', compact('pelapor'));
    }

    public function update(Request $request, $id)
    {
        $pelapor = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pelapor->id,
        ]);

        $pelapor->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.kelolapelapor.index')->with('success', 'Data pelapor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelapor = User::findOrFail($id);
        $pelapor->delete();

        return redirect()->route('admin.kelolapelapor.index')->with('success', 'Data pelapor berhasil dihapus.');
    }
}
 