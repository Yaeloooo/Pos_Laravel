<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrderController;


// La ruta para CARGAR la página donde están los dos formularios
Route::get('/add-product', [ProductController::class, 'index'])->name('add-product');

// La ruta para el formulario de PRODUCTOS
// Cambiamos el nombre a 'products.store' para que coincida con tu Blade
Route::post('/add-product/store', [ProductController::class, 'store'])->name('products.store');

// La ruta para el formulario de CATEGORÍAS
Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');

//Ruta para los Clientes
Route::post('/clientes/store',[ClienteController::class, 'store'])->name('clientes.store');

//Ruta para ordenes
Route::post('/orders/store',[OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/store',[OrderController::class, 'index'])->name('orders.index');

//Rutas para editar PRODUCTOS
Route::get('/order/{id}/edit',[OrderController::class, 'edit'])->name('orders.edit');
Route::put('/order/{id}',[OrderController::class, 'update'])->name('order.update');












