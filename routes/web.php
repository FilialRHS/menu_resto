<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin-test', function () {
    return 'ADMIN OK';
})->middleware(['auth', 'is_admin']);

use App\Http\Controllers\CategoryController;

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});