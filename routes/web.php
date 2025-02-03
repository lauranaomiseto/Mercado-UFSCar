<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesReportController;


use App\Http\Middleware\CheckUserRole;


Route::controller(LoginController::class)->group(function (){
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store'); 
    Route::get('/logout', 'destroy')->name('login.destroy');
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('can:gestao-usuarios')->group(function (){
    Route::controller(UserController::class)->group(function (){
        Route::get('/users', 'index')->name('users');
        Route::get('/users/create', 'create')->name('users.create'); // p/ form de adição
        Route::post('/users', 'store')->name('users.store'); // realiza o cadastro efetivamente
        Route::get('/users/{user}/edit', 'edit')->name('users.edit'); // p/ form de edição
        Route::put('/users/{user}', 'update')->name('users.update'); // realiza o update efetivamente
        Route::get('/users/{user}', 'show')->name('users.show');
        Route::delete('/users/{user}', 'destroy')->name('users.destroy');
    });
});

Route::middleware('can:gestao-produtos')->group(function (){
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products'); // p/ listagem
        Route::get('/products/create', 'create')->name('products.create'); // p/ form de adição
        Route::post('/products', 'store')->name('products.store'); // realiza o cadastro efetivamente
        Route::get('/products/{product}/edit', 'edit')->name('products.edit'); // p/ form de edição
        Route::put('/products/{product}', 'update')->name('products.update'); // realiza o update efetivamente
        Route::get('/products/{product}', 'show')->name('products.show');
        Route::delete('/products/{product}', 'destroy')->name('products.destroy');
    });
});

// como as rotas declaradas acima respeitam o padrão -resources do laravel
// essa única declaração funciona para o grupo todo
// Route::resource('products', ProductController::class);

Route::middleware('can:gestao-estoque')->group(function (){
    Route::controller(BatchController::class)->group(function () {
        Route::get('/batches', 'index')->name('batches'); // p/ listagem
        Route::get('/batches/create', 'create')->name('batches.create'); // p/ form de adição
        Route::post('/batches', 'store')->name('batches.store'); // realiza o cadastro efetivamente
        Route::get('/batches/{batch}/edit', 'edit')->name('batches.edit'); // p/ form de edição
        Route::put('/batches/{batch}', 'update')->name('batches.update'); // realiza o update efetivamente
        Route::get('/batches/{batch}', 'show')->name('batches.show');
        Route::delete('/batches/{batch}', 'destroy')->name('batches.destroy');
    });
});


Route::middleware('can:operacao-vendas')->group(function (){
    Route::controller(SaleController::class)->group(function () {
        Route::get('/sales', 'index')->name('sales'); // p/ listagem
        Route::get('/sales/create', 'create')->name('sales.create'); // p/ form de adição
        Route::post('/sales', 'store')->name('sales.store'); // realiza o cadastro efetivamente
        Route::get('/sales/{sale}/edit', 'edit')->name('sales.edit'); // p/ form de edição
        Route::put('/sales/{sale}', 'update')->name('sales.update'); // realiza o update efetivamente
        Route::get('/sales/{sale}', 'show')->name('sales.show');
        Route::delete('/sales/{sale}', 'destroy')->name('sales.destroy');
    });
});

Route::controller(SalesReportController::class)->group(function () {
    Route::get('/reports', 'salesReport')->name('report'); // Exibir relatório
});
