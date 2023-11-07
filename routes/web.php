<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');  
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });

Route::get('/send-mail', [SendEmailController::class,'index'])->name('kirim-email');
Route::post('/postemail', [SendEmailController::class, 'store'])->name('postemail');   

Route::controller(DashboardController::class)->group(function () {
    Route::get('/image', 'index')->name('image');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/store-edit/{id}', 'sendEdit')->name('storeEdit');
});