<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/welcome', function (){
    return view('welcome');
})->name('welcome');

// Auth::routes();
Route::group(['middleware' => ['auth']], function (){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::post('/apiLogin', [AuthController::class, 'apiLogin'])->name('apiLogin');
Route::post('/apiRegister', [AuthController::class, 'apiRegister'])->name('apiRegister');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

