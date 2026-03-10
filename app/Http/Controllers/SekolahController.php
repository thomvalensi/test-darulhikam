<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Yayasan;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolah = Sekolah::all();
        $yayasan = Yayasan::all();
        return view('sekolah.index', compact('sekolah', 'yayasan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'yayasan_id' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $sekolah = new Sekolah();
        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->yayasan_id = $request->yayasan_id;
        $sekolah->alamat = $request->alamat;
        $sekolah->telepon = $request->telepon;
        $sekolah->save();

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'yayasan_id' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $sekolah->nama_sekolah = $request->nama_sekolah;
        $sekolah->yayasan_id = $request->yayasan_id;
        $sekolah->alamat = $request->alamat;
        $sekolah->telepon = $request->telepon;
        $sekolah->save();

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();
        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil dihapus');
    }
}
