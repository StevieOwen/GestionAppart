<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppartmentController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;

Route::controller(DefaultController::class)->group(function(){
    Route::get('/','index')->name('/');
});

Route::middleware('auth')->group(function() {
    Route::controller(BuildingController::class)->group(function(){
        Route::get('building/create','create')->name('buildings.create');
        Route::post('building/store','store')->name('buildings.store');
        Route::get('buildings','index')->name('buildings.index');
        Route::get('buildings/{id}/edit','edit')->name('buildings.edit');
        Route::put('buildings/{id}','update')->name('buildings.update');
        Route::delete('buildings/{id}','destroy')->name('buildings.delete');

    });
});

Route::middleware('auth')->group(function() {
    Route::controller(AppartmentController::class)->group(function(){
        Route::get('appartments/create','create')->name('appartments.create');
        Route::post('appartments/store','store')->name('appartments.store');
        Route::get('appartments','index')->name('appartments.index');
        Route::get('appartments/{id}/edit','edit')->name('appartments.edit');
        Route::put('appartments/{id}','update')->name('appartments.update');
        Route::delete('appartments/{id}','destroy')->name('appartments.delete');

    });
});

Route::middleware('auth')->group(function() {
    Route::controller(BookingController::class)->group(function(){
        Route::get('bookings/create','create')->name('bookings.create');
        Route::post('bookings/store','store')->name('bookings.store');
        Route::get('bookings','index')->name('bookings.index');
        Route::get('bookings/{id}/edit','edit')->name('bookings.edit');
        Route::put('bookings/{id}','update')->name('bookings.update');
        Route::patch('bookings-status','update_status')->name('bookings.update-status');
        Route::delete('bookings/{id}','destroy')->name('bookings.delete');
    
    });
});

Route::middleware('auth')->group(function() {
    Route::controller(CustomerController::class)->group(function(){
        Route::get('customers/{id}/edit','edit')->name('customers.edit');
        Route::put('customers/{id}','update')->name('customers.update');
        Route::delete('customers/{id}','destroy')->name('customers.delete');
        Route::get('customer/book/appartment/{id}','book_appartment')->name('customers.book-appartment');
        Route::get('customer/bookings','showbookings')->name('customers.bookings');
        Route::put('customer/cancel-booking','cancelBooking')->name('customers.cancel-booking');
        Route::get('customer/settings','settings')->name('customers.settings');
        Route::put('customer/update-profile','updateProfile')->name('customers.update-profile');
        Route::put('customer/update-password','updatePassword')->name('customers.update-password');
        Route::put('customer/notifications','updateNotifications')->name('customer.notifications.update');

    });
});

Route::middleware('auth')->group(function() {
    Route::controller(ManagerController::class)->group(function(){
        Route::get('overview','overview')->name('overview');
        Route::get('settings','settings')->name('settings');
        Route::post('manager/update-profile','updateProfile')->name('manager.settings.profile.update');
        Route::post('manager/update-password','updatePassword')->name('manager.settings.password.update');
        Route::post('manager/settings-notification','updateNotifications')->name('manager.settings.notifications.update');
    });
});
