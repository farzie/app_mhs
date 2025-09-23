<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswas;
use Illuminate\Http\Request;

class Mahasiswa extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswas::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function store(Request $request) {
        Mahasiswas::create(['nama' => $request->nama]);
        return redirect('/mahasiswa');
    }

    public function update(Request $request, $id) {
        $mahasiswa = Mahasiswas::findOrFail($id);;
        $mahasiswa->update(['nama' => $request->nama]);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate!');
    }

    public function destroy($id) {
        $mhs = Mahasiswas::findOrFail($id);
        $mhs->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }


}

