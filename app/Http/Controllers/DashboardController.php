<?php

namespace App\Http\Controllers;

use App\Models\Yayasan;
use App\Models\Sekolah;

class DashboardController extends Controller
{
    public function index()
    {
        $totalYayasan = Yayasan::count();
        $totalSekolah = Sekolah::count();

        $latestYayasan = Yayasan::latest()->take(5)->get();
        $latestSekolah = Sekolah::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalYayasan',
            'totalSekolah',
            'latestYayasan',
            'latestSekolah'
        ));
    }
}