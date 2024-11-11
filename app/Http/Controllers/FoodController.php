<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Halaman utama
    public function index()
    {
        return view('welcome');
    }

    // Halaman rekomendasi
    public function rekomendasi()
    {
        $popularProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sales'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sales')
            ->take(5) // Ambil 5 produk terpopuler, sesuaikan dengan kebutuhan
            ->get();
        return view('rekomendasi', compact('popularProducts'));
    }

    // Halaman pencarian
    public function search(Request $request)
    {
        $query = $request->input('search'); // Ambil query dari form pencarian

        if (empty($query)) {
            $filteredFoods = collect([]); // Pastikan tetap menggunakan Collection meskipun kosong
        } else {
            // Gunakan model Product untuk mencari makanan berdasarkan nama
            $filteredFoods = Product::where('name', 'like', '%' . $query . '%')->get();
        }

        return view('search', compact('filteredFoods', 'query'));
    }
}
