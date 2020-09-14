<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return redirect()->route('tickets.index');
    });
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}/tickets', [CustomerController::class, 'tickets'])->name('customers.tickets');

});


Route::middleware('guest')->group(function() {
    Route::get('/', function () {
        return redirect()->route('tickets.create');
    });
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
});
