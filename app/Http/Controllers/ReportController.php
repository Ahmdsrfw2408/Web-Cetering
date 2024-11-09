<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function customerReport()
    {
        // Mengambil semua data pelanggan
        $customers = User::where('role', 'customer')->get();

        return view('reports.customers', compact('customers'));
    }

    public function orderReport()
    {
        // Mengambil semua data pesanan dari tabel payments
        $orders = Payment::with('user')->get(); // Mengambil pembayaran beserta relasi user

        return view('reports.orders', compact('orders'));
    }

    public function productReport()
    {
        // Mengambil semua data produk
        $products = Product::all();

        return view('reports.products', compact('products'));
    }

    public function downloadOrderReportPdf()
    {
        $orders = Payment::with('user')->get();

        $pdf = PDF::loadView('reports.orders_pdf', compact('orders'));

        // Atur orientasi dan ukuran halaman (opsional)
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan_pesanan.pdf');
    }
}
