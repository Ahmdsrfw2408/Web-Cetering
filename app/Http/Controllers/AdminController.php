<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua pengguna
        $jumlahmakanan = Product::count();
        return view('admin.dashboard', compact('jumlahmakanan', 'users'));
    }

    public function manageCustomers()
    {
        // Ambil semua produk dari database
        $products = Product::all();


        // Logika untuk mengelola pelanggan
        return view('admin.customers', compact('products'));
    }
}
