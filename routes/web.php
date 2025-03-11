<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\History\HistoryPayment;
use App\Livewire\Payment\PaymentInput;
use App\Livewire\Pelanggan\Pelanggan;
use App\Livewire\Product\Product;
use App\Livewire\UserAdmin\UserAdmin;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return auth()->check() ? redirect(route('dashboard')) : redirect(route('login'));
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/user-admin', UserAdmin::class)->middleware(['role:superAdmin'])->name('user-admin');

    Route::middleware(['role:superAdmin|admin'])->group(function() {
        Route::get('/customer', Pelanggan::class)->name('pelanggan');
        Route::get('/product', Product::class)->name('product');
        Route::get('/payment-input', PaymentInput::class)->name('payment-input');
        Route::get('/history-payment', HistoryPayment::class)->name('history');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
