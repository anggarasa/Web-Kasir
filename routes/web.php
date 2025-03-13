<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return auth()->check() ? redirect(route('dashboard')) : redirect(route('login'));
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');


    Route::middleware(['role:superAdmin|admin'])->group(function() {
        // Route::get('/payment-input', PaymentInput::class)->name('payment-input');
        // Route::get('/history-payment', HistoryPayment::class)->name('history');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
