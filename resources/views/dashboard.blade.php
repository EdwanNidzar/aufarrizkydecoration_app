<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Orders</h1>
                    <form method="GET" action="{{ url('/dashboard') }}" class="mb-4 flex items-center gap-2 inline-flex">
                        <input type="date" name="start_date" class="border rounded px-2 py-1" value="{{ request('start_date') }}">
                        <input type="date" name="end_date" class="border rounded px-2 py-1" value="{{ request('end_date') }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                    </form>

                    <a href="{{ url('/dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded inline-flex">
                        Reset
                    </a>
                    
                    <a href="{{ url('/export-orders?start_date='.request('start_date').'&end_date='.request('end_date')) }}" 
                       class="bg-green-500 text-white px-4 py-2 rounded inline-flex">
                       Export Excel
                    </a>
                    
                    
                    {{-- uncomment this code if you want to import excel
                    <form action="{{ url('/import-orders') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <input type="file" name="file" required class="block mb-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Import Excel</button>
                    </form> --}}

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Catalog Name</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Order Date</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Price</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 tracking-wider">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-200">{{ $item->catalog->nama }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200">{{ $item->tanggal_order }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 border-b border-gray-200">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-100 font-bold">
                                    <td colspan="3" class="px-6 py-4 border-t text-right">Total Keseluruhan:</td>
                                    <td class="px-6 py-4 border-t">
                                        Rp {{ number_format(collect($data->items())->sum('total_harga'), 0, ',', '.') }}
                                    </td>
                                    
                                </tr>
                            </tfoot>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
