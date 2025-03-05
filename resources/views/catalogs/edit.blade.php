<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Katalog') }}
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

                    <form action="{{ route('catalogs.update', $catalog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama</label>
                            <input type="text" name="nama" value="{{ $catalog->nama }}" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full p-2 border rounded" required>{{ $catalog->deskripsi }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Harga</label>
                            <input type="number" name="harga" value="{{ $catalog->harga }}" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Gambar Saat Ini</label>
                            <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->nama }}" class="w-1/2 h-auto object-cover">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Ganti Gambar</label>
                            <input type="file" name="image" class="w-full p-2 border rounded">
                        </div>
                        <div class="flex justify-end space-x-2 gap-2">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                            <a href="{{ route('catalogs.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
