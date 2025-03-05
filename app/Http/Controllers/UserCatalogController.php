<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserCatalogController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $catalogs = Catalog::all();
        return view('user-catalog', compact('catalogs'));
    }
    public function show($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('user-catalog-detail', compact('catalog'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'catalog_id' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'harga' => 'required|numeric',
        ]);

        $catalog = Catalog::findOrFail($request->catalog_id);

        // Cek apakah pengguna sudah memiliki order di tanggal yang sama untuk katalog ini
        $existingOrder = Order::where('user_id', auth()->id())
            ->where('catalog_id', $request->catalog_id)
            ->whereDate('waktu_mulai', $request->waktu_mulai)
            ->exists();

        if ($existingOrder) {
            return redirect()->back()->with('error', 'Anda sudah memiliki order untuk katalog ini pada tanggal yang sama.');
        }

        // Hitung durasi dalam hari
        $durasi = Carbon::parse($request->waktu_mulai)->diffInDays(Carbon::parse($request->waktu_selesai));

        // Jika durasi 0 hari, set minimal 1 hari
        if ($durasi == 0) {
            $durasi = 1;
        }

        // Hitung total harga berdasarkan durasi
        $total_harga = $catalog->harga * $durasi;

        // Simpan data order
        Order::create([
            'user_id' => auth()->id(),
            'catalog_id' => $request->catalog_id,
            'tanggal_order' => Carbon::now(),
            'durasi' => $durasi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'harga' => $catalog->harga,
            'total_harga' => $total_harga,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Order berhasil dibuat, silakan lanjut ke pembayaran!');
    }
}
