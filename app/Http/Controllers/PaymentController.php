<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        $user = Auth::user();
        // Ambil total harga dari sesi, jika tidak ada set default 0
        $totalPrice = Session::get('total_price', 0);

        // Jika total price masih 0, arahkan kembali ke keranjang
        if ($totalPrice == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang anda kosong atau total harga tidak ditemukan.');
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;


        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => 'Nama Default',
                'email' => 'email@default.com',
                'phone' => '081234567890',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payments.create', compact('totalPrice', 'user'));
    }

    public function processPayment(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'altujuan' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,13',
            'payment_method' => 'required|string',
        ]);

        try {
            // Ambil total harga dari sesi
            $amount = Session::get('total_price', 0);

            // Hitung ongkos kirim berdasarkan kecamatan yang dipilih
            $ongkosKirim = match ($request->input('altujuan')) {
                'Martapura Timur' => 12000,
                'Martapura Barat' => 14000,
                'Martapura Kota' => 10000,
                'Banjarbaru Utara' => 15000,
                'Banjarbaru Selatan' => 16000,
                'Banjarmasin Timur' => 20000,
                'Banjarmasin Barat' => 21000,
                default => 0,
            };



            $totalPrice = $amount + $ongkosKirim;

            // Konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;


            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ],
                'callbacks' => [
                    'finish' => route('payment.showPaymentSuccess')  // URL setelah transaksi berhasil
                ]
            ];
            $transaction = Snap::createTransaction($params);
            $redirectUrl = $transaction->redirect_url;

            // Simpan detail pembayaran ke database
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

            // Simpan setiap item pesanan
            $cartItems = Session::get('cart', []);
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'payment_id' => $payment->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Hapus sesi
            Session::forget(['total_price', 'cart']);

            // Kirim token ke view untuk Snap Popup
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function manageOrders()
    {
        $orders = Payment::with(['user', 'items.product'])->get(); // Ambil semua data pesanan beserta itemnya
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
        $snapToken = session('snapToken');

        if (!$order) {
            return redirect()->route('customer.dashboard')->with('error', 'Pesanan tidak ditemukan.');
        }

        $totalPriceWithShipping = $order->total_price;
        $shippingCost = $order->shipping_cost;

        return view('payments.success', compact('order', 'totalPriceWithShipping', 'shippingCost', 'snapToken'));
    }
}
