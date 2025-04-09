<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PuntoVentaController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);


Route::get('punto-venta', [PuntoVentaController::class, 'index'])->name('punto-venta.index');
Route::post('punto-venta', [PuntoVentaController::class, 'store'])->name('punto-venta.store');

Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');