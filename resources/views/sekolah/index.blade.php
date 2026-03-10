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
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">Data Sekolah</h2>

            <button @click="openCreate = true" class="bg-blue-500 text-white px-4 py-2 rounded">
                + Tambah Sekolah
            </button>
        </div>

        {{-- Table --}}
        <table class="w-full border border-gray-200">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Sekolah</th>
                    <th class="p-3 text-left">Yayasan</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-left">Telepon</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($sekolah as $s)

                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $s->nama_sekolah }}</td>
                        <td class="p-3">{{ $s->yayasan->nama_yayasan }}</td>
                        <td class="p-3">{{ $s->alamat }}</td>
                        <td class="p-3">{{ $s->telepon }}</td>

                        <td class="p-3 flex gap-2">

                            <button @click="editId = {{ $s->id }}"
                                class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">
                                Edit
                            </button>

                            <button @click="deleteId = {{ $s->id }}"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>

                        </td>

                    </tr>

                    {{-- MODAL EDIT SEKOLAH --}}
                    <div x-show="editId === {{ $s->id }}" x-transition
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

                        <div @click.away="editId = null" class="bg-white p-6 rounded-lg shadow-lg w-96">

                            <h3 class="text-xl font-semibold mb-4">
                                Edit Sekolah
                            </h3>

                            <form action="{{ route('sekolah.update', $s->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Nama Yayasan
                                    </label>

                                    <select name="yayasan_id"
                                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                                        @foreach ($yayasan as $y)
                                            <option value="{{ $y->id }}">{{ $y->nama_yayasan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Nama Sekolah
                                    </label>

                                    <input type="text" name="nama_sekolah" value="{{ $s->nama_sekolah }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Alamat
                                    </label>

                                    <textarea name="alamat" rows="3"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">{{ $s->alamat }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-600 font-semibold mb-1">
                                        Telepon
                                    </label>

                                    <input type="text" name="telepon" value="{{ $s->telepon }}"
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

        {{-- MODAL TAMBAH SEKOLAH --}}
        <div x-show="openCreate" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

            <div @click.away="openCreate = false" class="bg-white p-6 rounded-lg shadow-lg w-96">

                <h3 class="text-xl font-semibold mb-4">
                    Tambah Sekolah
                </h3>

                <form action="{{ route('sekolah.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-600 font-semibold mb-1">
                            Nama Yayasan
                        </label>

                        <select name="yayasan_id" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                            @foreach ($yayasan as $y)
                                <option value="{{ $y->id }}">{{ $y->nama_yayasan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah"
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

        {{-- MODAL DELETE SEKOLAH --}}
        <div x-show="deleteId !== null" x-transition
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

            <div @click.away="deleteId = null" class="bg-white rounded-lg shadow-lg w-96 p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    Konfirmasi Hapus
                </h3>

                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus sekolah ini?
                </p>

                <div class="flex justify-end gap-2">

                    <button @click="deleteId = null" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>

                    <form :action="`{{ url('sekolah') }}/${deleteId}`" method="POST">

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