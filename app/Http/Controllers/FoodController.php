<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('rekomendasi');
    }

    // Halaman pencarian
    public function search(Request $request)
    {
        $query = $request->input('query'); // Ambil query dari form pencarian

        if (empty($query)) {
            $filteredFoods = collect([]); // Pastikan tetap menggunakan Collection meskipun kosong
        } else {
            // Gunakan model Product untuk mencari makanan berdasarkan nama
            $filteredFoods = Product::where('name', 'like', '%' . $query . '%')->get();
        }

        return view('search', compact('filteredFoods', 'query'));
    }
}
