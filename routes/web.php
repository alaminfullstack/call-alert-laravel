<?php

use App\Http\Controllers\AppoitmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SliderController;

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

Route::get('/login', [AuthController::class, 'show_login']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'show_register']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('admin')->middleware(['auth'])->group(function () {
   
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    // sliders
    Route::resource('sliders', SliderController::class)->names('sliders');

    // posts
    Route::resource('posts', PostController::class)->names('posts');

    // bookings
    Route::resource('bookings', BookingController::class)->names('bookings');

    // payment methods
    Route::resource('payment-methods', PaymentMethodController::class)->names('payment-methods');

});


Route::get('/booking-payment/{id}', [FrontendController::class, 'payment'])->name('payment');
Route::post('/booking-payment-save/{id}', [FrontendController::class, 'payment_save'])->name('payment_save');
Route::get('/post-booking/{id}', [FrontendController::class, 'booking'])->name('booking');
Route::post('/post-booking-save/{id}', [FrontendController::class, 'booking_save'])->name('booking_save');
Route::get('/post-details/{id}', [FrontendController::class, 'details'])->name('details');
Route::get('/about-us', [FrontendController::class, 'about_us'])->name('about_us');
Route::get('/how-to-book', [FrontendController::class, 'how_to_book'])->name('how_to_book');
Route::get('/terms-and-condition', [FrontendController::class, 'terms'])->name('terms');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/', [FrontendController::class, 'index'])->name('welcome');
