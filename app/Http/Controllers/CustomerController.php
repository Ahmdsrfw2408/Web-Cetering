<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil semua produk dari database
        $products = Product::all();
        return view('customer.dashboard', compact('products'));
    }
    public function hm()
    {
        // Ambil semua produk dari database
        $products = Product::all();
        return view('home', compact('products'));
    }
    public function ab()
    {
        // Ambil semua produk dari database
        $products = Product::all();
        return view('about', compact('products'));
    }
    public function ct()
    {
        // Ambil semua produk dari database
        $products = Product::all();
        return view('contact', compact('products'));
    }
}
