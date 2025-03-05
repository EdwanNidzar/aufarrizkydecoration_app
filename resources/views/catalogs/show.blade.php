<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Katalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold">{{ $catalog->nama }}</h3>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-700">{{ $catalog->deskripsi }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-bold text-gray-900">Harga: Rp {{ number_format($catalog->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->nama }}" class="w-1/2 h-auto object-cover">
                    </div>
                    <div>
                        <a href="{{ route('catalogs.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
