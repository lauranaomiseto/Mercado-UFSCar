<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


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


