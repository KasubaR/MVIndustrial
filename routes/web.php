<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])->name('services.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.send');
