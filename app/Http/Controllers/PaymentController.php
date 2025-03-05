<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::whereDoesntHave('payment', function ($query) {
            $query->where('status', 'approve');
        })
            ->with('catalog', 'payment')
            ->get();

        return view('payment', compact('orders'));
    }

    /**
     * Proses pembayaran.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Upload bukti pembayaran
        $filename = $request->file('bukti_pembayaran')->store('payments', 'public');

        // Simpan data pembayaran
        $payment = Payment::create([
            'order_id' => $order->id,
            'bukti_pembayaran' => $filename,
            'tanggal_pembayaran' => now(),
            'status' => 'paid', // Status bisa diubah setelah diverifikasi
        ]);

        // Ubah status order menjadi success
        $order->update(['status' => 'success']);

        return redirect()->route('order.payment')->with('success', 'Bukti pembayaran berhasil diunggah dan status order telah diubah menjadi paid!');
    }

    public function admin()
    {
        $payments = Payment::with('order')->get();

        return view('payments.index', compact('payments'));
    }

    public function paymentApprove($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->update(['status' => 'approve']);

        return redirect()->route('payment.admin')->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    public function paymentReject($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->update(['status' => 'reject']);

        return redirect()->route('payment.admin')->with('success', 'Pembayaran berhasil ditolak!');
    }

}
