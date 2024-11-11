<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\FoodController;

Route::get('/', [FoodController::class, 'index'])->name('welcome'); // Home page
Route::get('/rekomendasi', [FoodController::class, 'rekomendasi'])->name('rekomendasi'); // Rekomendasi page
Route::get('/search', [FoodController::class, 'search'])->name('search');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/customers', [AdminController::class, 'manageCustomers'])->name('admin.customers');
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/kelola', [PaymentController::class, 'manageOrders'])->name('admin.products.kelola');
    Route::put('/admin/products/{order}/update-status', [PaymentController::class, 'updateStatus'])->name('admin.products.updateStatus');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/reports/customers', [ReportController::class, 'customerReport'])->name('reports.customers');
    Route::get('/reports/orders', [ReportController::class, 'orderReport'])->name('reports.orders');
    Route::get('/reports/products', [ReportController::class, 'productReport'])->name('reports.products');
    Route::get('/reports/orders/pdf', [ReportController::class, 'downloadOrderReportPdf'])->name('reports.orders.pdf');
    Route::post('/upload-avatar', [AdminController::class, 'uploadAvatar'])->name('upload-avatar');
});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/home', [CustomerController::class, 'hm'])->name('home');
    Route::get('/about', [CustomerController::class, 'ab'])->name('about');
    Route::get('/contact', [CustomerController::class, 'ct'])->name('contact');
    Route::get('/menu', [ProductController::class, 'ind'])->name('menu.index');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [PaymentController::class, 'showPaymentSuccess'])->name('payment.showPaymentSuccess');
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.create')->middleware('auth');
    Route::post('/payments/{payment}/confirm-delivery', [PaymentController::class, 'confirmDelivery'])->name('payments.confirmDelivery');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/history', [CartController::class, 'history'])->name('cart.history');
    Route::post('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__ . '/auth.php';
