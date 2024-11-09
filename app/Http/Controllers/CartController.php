<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $totalPrice = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        return view('carts.index', compact('carts', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        // Cek jika stok produk cukup
        if ($product->jumlah < $request->quantity) {
            return response()->json(['success' => false, 'message' => 'Stok tidak cukup']);
        }

        // Cari atau buat keranjang untuk user saat ini
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => 0]
        );

        // Update kuantitas produk di keranjang
        $cart->quantity += $request->quantity;
        $cart->save();

        // Kurangi stok produk
        $product->decrement('jumlah', $request->quantity);

        // Ambil semua item keranjang user untuk menghitung ulang total harga
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $totalPrice = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);


        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1', // Pastikan quantity >= 1
        ]);

        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);

        // Hitung perubahan kuantitas yang diinginkan
        $quantityChange = $request->quantity - $cart->quantity;

        // Cek jika stok produk cukup untuk perubahan ini
        if ($product->jumlah < $quantityChange) {
            return redirect()->route('cart.index')->with('error', 'Stok tidak cukup untuk memperbarui kuantitas');
        }

        // Update kuantitas di keranjang
        $cart->quantity = $request->quantity;
        $cart->save();

        // Update stok produk
        $product->decrement('jumlah', $quantityChange);

        return redirect()->route('cart.index')->with('success', 'Kuantitas berhasil diperbarui');
    }

    public function history()
    {
        $orders = Payment::where('user_id', Auth::id())->with('items.product')->get();

        return view('carts.history', compact('orders'));
    }


    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus');
    }

    public function checkout()
    {
        // Ambil semua item di keranjang untuk user yang sedang login
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        // Hitung total harga dari semua item di keranjang
        $totalPrice = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        // Simpan item keranjang dan total harga ke sesi
        Session::put('cart', $carts->map(function ($cart) {
            return [
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ];
        })->toArray());

        // Simpan total harga ke sesi
        Session::put('total_price', $totalPrice);

        // Alihkan ke halaman pembayaran
        return redirect()->route('payment.create')->with('totalPrice', $totalPrice);
    }
}
