<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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

Route::Group(['prefix' => 'DanhSachKhachSan'], function () {
    // Get hien thi login
    Route::get('login', [CustomerController::class, 'login'])->name('DanhSachKhachSan.login');
    // hieenr thi register
    Route::get('register', [CustomerController::class, 'register'])->name('DanhSachKhachSan.register');

    Route::post('login', [CustomerController::class, 'post_login']);
    Route::post('register', [CustomerController::class, 'post_register']);
    Route::get('index', [CustomerController::class, 'index'])->name('index');
    Route::get('addNew', [CustomerController::class, 'AddNew'])->name('addHotel');
    Route::post('addNew', [CustomerController::class, 'addHotel_database'])->name('addHotel_database');
    Route::delete('index/{id}', [CustomerController::class, 'delete_hotel'])->name('delete_hotel');
    Route::get('index/edit/{id}', [CustomerController::class, 'hotel_edit'])->name('hotel.edit');
    Route::put('index/edit/{id}', [CustomerController::class, 'hotel_update'])->name('student.update');
});
