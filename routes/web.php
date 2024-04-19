<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageDoctorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\HistoryBookingController;
use App\Http\Controllers\AdminBanners;

use App\Http\Controllers\FavoriteDoctorsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
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
//Payment
Route::get('/payment/{user_id}/{doctor_id}/{date}/{time_id}', [PaymentController::class, 'index']);
// PATIENT
Route::post('/api/patient/search', [SearchController::class, 'search']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'aboutUs']);
Route::get('/contact-us', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');


// Route::get('/doctors', [HomeController::class, 'doctors']);
Route::get('/doctors', [DoctorController::class, 'index']);
Route::post('/doctor/favorite', [DoctorController::class, 'favoriteDoctor']);
Route::get('/favorite-doctors', [FavoriteDoctorsController::class, 'index']);

// Route::get('/favorite-doctors/delete/{id}', [FavoriteDoctorsController::class, 'delete'])->name('delete');
Route::delete('/favorites/{id}', [FavoriteDoctorsController::class, 'destroy'])->name('favorites.destroy');
Route::get('/services', [HomeController::class, 'services']);
//Common
Route::get('/sign-in', [SignInController::class, 'index']);
Route::post('/api/sign-in', [SignInController::class, 'signIn']);
Route::get('/sign-up', [SignUpController::class, 'index']);
Route::post('/api/patient/sign-up', [SignUpController::class, 'signUp']);
// ADMIN
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);

    Route::prefix('patients')->group(function () {
        Route::get('/', [AdminPatientController::class, 'index']);
        Route::get('/create', [AdminPatientController::class, 'create'])->name('create');
        Route::post('/create', [AdminPatientController::class, 'store'])->name('admin.patients.store');
        Route::get('{user_id}/update', [AdminPatientController::class, 'edit'])->name('edit.patient');
        Route::put('{user_id}/update', [AdminPatientController::class, 'update'])->name('update.patient');
        Route::get('{id}/delete', [AdminPatientController::class, 'destroy'])->name('delete_patient');
        Route::get('/search', [AdminPatientController::class, 'search']);
    });

    // Route cho quản lý bác sĩ
    Route::prefix('doctors')->group(function () {
        Route::get('/', [AdminDoctorController::class, 'index']);
        Route::get('/create', [AdminDoctorController::class, 'create']);
        Route::post('/create', [AdminDoctorController::class, 'store']);
        Route::get('/{id}/edit', [AdminDoctorController::class, 'edit']);
        Route::post('/{id}', [AdminDoctorController::class, 'update']);
        Route::get("/delete/doctor/{id}", [AdminDoctorController::class, 'destroy'])->name('deletedoctor');
        Route::get('/search_doctor/search', [AdminDoctorController::class, 'search_doctor'])->name('search_doctor');
    });
    Route::prefix('banners')->group(function () {
        Route::get('/', [AdminBanners::class, 'index']);
        Route::get('/create', [AdminBanners::class, 'create']);
        Route::post('/create', [AdminBanners::class, 'store']);
        Route::get('/banner/{id}/edit', [AdminBanners::class, 'edit']);
        Route::put('/banner/{id}/edit', [AdminBanners::class, 'update']);
        Route::get("/banner/{id}/delete", [AdminBanners::class, 'destroy']);
    });


    // Route cho bảng điều khiển admin
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/contact', [AdminContactController::class, 'index'])->name('admin.contact');


    // Route cho quản lý cuộc hẹn
    Route::get('/appointment', [AdminAppointmentController::class, 'index']);
    Route::post('/appointment/{id}/update-status', [AdminAppointmentController::class, 'updateStatus'])->name('appointment.updateStatus');

    
});
Route::get('contact/{id}', [AdminContactController::class, 'update_contact_message'])->name('contact.update');



Route::get('/doctor/{id}/booking', [BookingController::class, 'index']);
Route::post('/patient/list-doctor/booking/time', [BookingController::class, 'checkTime']);
Route::post('/patient/list-doctor/booking', [BookingController::class, 'booking']);
Route::get('/Profile/{id}', [ProfileController::class, 'index']);
Route::put('/Profile/{id}', [ProfileController::class, 'update']);

Route::get('/doctor/{id}/booking', [BookingController::class, 'index']);
Route::post('/patient/list-doctor/booking/time', [BookingController::class, 'checkTime']);
Route::post('/patient/list-doctor/booking', [BookingController::class, 'booking']);
Route::post('/patient/cart/booking', [BookingController::class, 'bookingCart']);

// Route::get('auth/google', function () {
//     return Socialite::driver('google')->redirect();
// });

Route::get('/add-to-cart/{id}', [AddToCartController::class, 'index']);
Route::post('/add-to-cart', [AddToCartController::class, 'add']);
Route::get('/cart/{id}', [AddToCartController::class, 'deleteCart'])->name('cart.delete');
Route::get('/carts/{id}', [AddToCartController::class, 'getCartById']);

Route::get('auth/google/callback', [SignInController::class, 'SignInGoogle']);
Route::post('/api/patient/processHistoryBooking',  [HistoryBookingController::class, 'processHistoryBooking']);
Route::get('/patient/history-booking',  [HistoryBookingController::class, 'index']);
