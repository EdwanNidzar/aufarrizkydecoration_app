<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Katalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('catalogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama</label>
                            <input type="text" name="nama" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full p-2 border rounded" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" name="harga" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Gambar</label>
                            <input type="file" name="image" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="flex justify-end space-x-2 gap-2">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                            <a href="{{ route('catalogs.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>