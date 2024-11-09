<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        // Ambil total harga dari sesi, jika tidak ada set default 0
        $totalPrice = Session::get('total_price', 0);

        // Jika total price masih 0, arahkan kembali ke keranjang
        if ($totalPrice == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang anda kosong atau total harga tidak ditemukan.');
        }

        return view('payments.create', compact('totalPrice'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'altujuan' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,13',
            'payment_method' => 'required|string',
        ]);

        try {
            $amount = Session::get('total_price', 0);

            $ongkosKirim = 0;
            switch ($request->input('altujuan')) {
                case 'Martapura':
                    $ongkosKirim = 10000;
                    break;
                case 'Banjarbaru':
                    $ongkosKirim = 15000;
                    break;
                case 'Banjarmasin':
                    $ongkosKirim = 20000;
                    break;
            }

            $totalPrice = $amount + $ongkosKirim;

            $payment = Payment::create([
                'user_id' => auth()->id(),
                'name' => $request->input('name'),
                'address' => $request->input('altujuan'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'payment_method' => $request->input('payment_method'),
                'amount' => $amount,
                'shipping_cost' => $ongkosKirim,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Simpan setiap item pesanan ke order_items
            $cartItems = Session::get('cart', []); // Ambil data keranjang dari sesi
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'payment_id' => $payment->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            Session::forget(['total_price', 'cart']); // Hapus sesi setelah selesai

            return redirect()->route('payment.success')->with('success', 'Pembayaran berhasil diproses.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function manageOrders()
    {
        $orders = Payment::with(['user','items.product'])->get(); // Ambil semua data pesanan beserta itemnya
        return view('admin.products.kelola', compact('orders')); // Arahkan ke tampilan manage
    }


    public function confirmDelivery(Request $request, Payment $payment)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Simpan foto yang diunggah
        $photoPath = $request->file('photo')->store('delivery_photos', 'public');

        // Update status pesanan dan simpan path foto di database
        $payment->update([
            'status' => 'success',
            'photo' => $photoPath
        ]);

        return redirect()->route('cart.history')->with('success', 'Pesanan berhasil dikonfirmasi sebagai sudah sampai.');
    }

    public function updateStatus(Request $request, Payment $order)
    {
        $order->status = $request->input('status', 'pending');
        $order->save();

        return redirect()->route('admin.products.kelola')->with('success', 'Status pesanan berhasil diperbarui.');
    }



    public function success()
    {
        return view('payments.success');
    }

    public function showPaymentSuccess()
    {
        $order = Payment::where('user_id', Auth::id())->latest()->with('items.product')->first();

        if (!$order) {
            return redirect()->route('customer.dashboard')->with('error', 'Pesanan tidak ditemukan.');
        }

        $totalPriceWithShipping = $order->total_price;
        $shippingCost = match ($order->address) {
            'Martapura' => 10000,
            'Banjarbaru' => 15000,
            'Banjarmasin' => 20000,
            default => 0,
        };

        return view('payments.success', compact('order', 'totalPriceWithShipping', 'shippingCost'));
    }
}
