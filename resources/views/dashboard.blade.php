@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">
            Dashboard
        </h1>

        {{-- Statistik --}}
        <div class="grid grid-cols-2 gap-6 mb-8">

            <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                <h2 class="text-lg">Total Yayasan</h2>
                <p class="text-3xl font-bold">{{ $totalYayasan }}</p>
            </div>

            <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                <h2 class="text-lg">Total Sekolah</h2>
                <p class="text-3xl font-bold">{{ $totalSekolah }}</p>
            </div>

        </div>

        {{-- Data Terbaru --}}
        <div class="grid grid-cols-2 gap-6">

            {{-- Yayasan --}}
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-xl font-semibold mb-3">
                    Yayasan Terbaru
                </h3>

                <ul>
                    @foreach($latestYayasan as $y)
                        <li class="border-b py-2">
                            {{ $y->nama_yayasan }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Sekolah --}}
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-xl font-semibold mb-3">
                    Sekolah Terbaru
                </h3>

                <ul>
                    @foreach($latestSekolah as $s)
                        <li class="border-b py-2">
                            {{ $s->nama_sekolah }}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>

@endsection