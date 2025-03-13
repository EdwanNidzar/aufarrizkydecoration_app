<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Imports\OrdersImport;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('catalog')->latest();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_order', [$request->start_date, $request->end_date]);
        }

        $data = $query->paginate(10);
        return Auth::check() && Auth::user()->hasRole('user') ? redirect()->route('welcome') : view('dashboard', compact('data'));
    }

    public function exportOrders(Request $request)
    {
        return Excel::download(new OrdersExport($request->start_date, $request->end_date), 'orders.xlsx');
    }

    public function importOrders(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new OrdersImport(), $request->file('file'));

        return back()->with('success', 'Data berhasil diimpor!');
    }
}
