@extends('layouts.app')

@section('content')

    <div x-data="{ openCreate:false, editId:null, deleteId:null }" class="bg-white shadow rounded-lg p-6">

        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif


        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Data Yayasan</h2>

            <button @click="openCreate = true" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Tambah Yayasan
            </button>
        </div>


        {{-- Table --}}
        <table class="w-full border border-gray-200">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-left">Telepon</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($yayasan as $y)

                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $y->nama_yayasan }}</td>
                        <td class="p-3">{{ $y->alamat }}</td>
                        <td class="p-3">{{ $y->telepon }}</td>

                        <td class="p-3 flex gap-2">

                            <button @click="editId = {{ $y->id }}"
                                class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">
                                Edit
                            </button>

                            <button @click="deleteId = {{ $y->id }}"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>

                        </td>

                    </tr>

                    {{-- MODAL EDIT YAYASAN --}}
                    <div x-show="editId === {{ $y->id }}" x-transition
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

                        <div @click.away="editId = null" class="bg-white p-6 rounded-lg shadow-lg w-96">

                            <h3 class="text-xl font-semibold mb-4">
                                Edit Yayasan
                            </h3>

                            <form action="{{ route('yayasan.update', $y->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Nama Yayasan
                                    </label>

                                    <input type="text" name="nama_yayasan" value="{{ $y->nama_yayasan }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Alamat
                                    </label>

                                    <textarea name="alamat" rows="3"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">{{ $y->alamat }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Telepon
                                    </label>

                                    <input type="text" name="telepon" value="{{ $y->telepon }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
                                </div>

                                <div class="flex justify-end gap-2">

                                    <button type="button" @click="editId = null"
                                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                                        Batal
                                    </button>

                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Update
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                @endforeach

            </tbody>

        </table>

        {{-- MODAL TAMBAH YAYASAN --}}
        <div x-show="openCreate" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

            <div @click.away="openCreate = false" class="bg-white p-6 rounded-lg shadow-lg w-96">

                <h3 class="text-xl font-semibold mb-4">
                    Tambah Yayasan
                </h3>

                <form action="{{ route('yayasan.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Nama Yayasan</label>
                        <input type="text" name="nama_yayasan"
                            class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                            required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Telepon</label>
                        <input type="text" name="telepon"
                            class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex justify-end gap-2">

                        <button type="button" @click="openCreate = false"
                            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Batal
                        </button>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

        {{-- MODAL DELETE YAYASAN --}}
        <div x-show="deleteId !== null" x-transition
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

            <div @click.away="deleteId = null" class="bg-white rounded-lg shadow-lg w-96 p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    Konfirmasi Hapus
                </h3>

                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus yayasan ini?
                </p>

                <div class="flex justify-end gap-2">

                    <button @click="deleteId = null" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>

                    <form :action="`{{ url('yayasan') }}/${deleteId}`" method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection