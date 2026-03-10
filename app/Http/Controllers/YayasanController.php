<?php

namespace App\Http\Controllers;

use App\Models\Yayasan;
use Illuminate\Http\Request;

class YayasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yayasan = Yayasan::all();
        return view('yayasan.index', compact('yayasan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_yayasan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        Yayasan::create([
            'nama_yayasan' => $request->nama_yayasan,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('yayasan.index')
            ->with('success', 'Yayasan berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Yayasan $yayasan)
    {
        $request->validate([
            'nama_yayasan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $yayasan->update([
            'nama_yayasan' => $request->nama_yayasan,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('yayasan.index')
            ->with('success', 'Yayasan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yayasan $yayasan)
    {
        if ($yayasan->sekolah()->count() > 0) {
            return redirect()->route('yayasan.index')
                ->with('error', 'Yayasan tidak bisa dihapus karena masih memiliki sekolah.');
        }

        $yayasan->delete();

        return redirect()->route('yayasan.index')
            ->with('success', 'Yayasan berhasil dihapus');
    }
}