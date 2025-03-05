<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg" id="success-message">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-message').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <div class="mb-4">
                        <a href="{{ route('catalogs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Katalog</a>
                    </div>
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($catalogs as $catalog)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $catalog->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $catalog->deskripsi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($catalog->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->nama }}" class="w-16 h-16 object-cover">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('catalogs.edit', $catalog->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <a href="{{ route('catalogs.show', $catalog->id) }}" class="text-green-600 hover:text-green-900">Detail</a>
                                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $catalogs->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
