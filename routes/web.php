<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesReportController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::controller(UserController::class)->group(function (){
    Route::get('/users', 'index')->name('users');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products'); // p/ listagem
    Route::get('/products/create', 'create')->name('products.create'); // p/ form de adição
    Route::post('/products', 'store')->name('products.store'); // realiza o cadastro efetivamente
    Route::get('/products/{product}/edit', 'edit')->name('products.edit'); // p/ form de edição
    Route::put('/products/{product}', 'update')->name('products.update'); // realiza o update efetivamente
    Route::get('/products/{product}', 'show')->name('products.show');
    Route::delete('/products/{product}', 'destroy')->name('products.destroy');
});

// como as rotas declaradas acima respeitam o padrão -resources do laravel
// essa única declaração funciona para o grupo todo
// Route::resource('products', ProductController::class);

Route::controller(BatchController::class)->group(function () {
    Route::get('/batches', 'index')->name('batches'); // p/ listagem
    Route::get('/batches/create', 'create')->name('batches.create'); // p/ form de adição
    Route::post('/batches', 'store')->name('batches.store'); // realiza o cadastro efetivamente
    Route::get('/batches/{batch}/edit', 'edit')->name('batches.edit'); // p/ form de edição
    Route::put('/batches/{batch}', 'update')->name('batches.update'); // realiza o update efetivamente
    Route::get('/batches/{batch}', 'show')->name('batches.show');
    Route::delete('/batches/{batch}', 'destroy')->name('batches.destroy');
});


Route::controller(SaleController::class)->group(function () {
    Route::get('/sales', 'index')->name('sales'); // p/ listagem
    Route::get('/sales/create', 'create')->name('sales.create'); // p/ form de adição
    Route::post('/sales', 'store')->name('sales.store'); // realiza o cadastro efetivamente
    Route::get('/sales/{sale}/edit', 'edit')->name('sales.edit'); // p/ form de edição
    Route::put('/sales/{sale}', 'update')->name('sales.update'); // realiza o update efetivamente
    Route::get('/sales/{sale}', 'show')->name('sales.show');
    Route::delete('/sales/{sale}', 'destroy')->name('sales.destroy');
});


Route::controller(SalesReportController::class)->group(function () {
    Route::get('/reports', 'salesReport')->name('report'); // Exibir relatório
});
