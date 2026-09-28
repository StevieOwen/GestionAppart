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


Route::controller(BuildingController::class)->group(function(){
    Route::get('building/create','create')->name('building.create');
    Route::post('building/store','store')->name('building.store');
    Route::get('Buildings','index')->name('Buildings.index');
    Route::get('Buildings/{id}/edit','edit')->name('Buildings.edit');
    Route::put('Buildings/{id}','update')->name('Buildings.update');
    Route::delete('Buildings/{id}','destroy')->name('Buildings.delete');

});

Route::controller(AppartmentController::class)->group(function(){
    Route::get('appartments/create','create')->name('appartments.create');
    Route::post('appartments/store','store')->name('appartments.store');
    Route::get('appartments','index')->name('appartments.index');
    Route::get('appartments/{id}/edit','edit')->name('appartments.edit');
    Route::put('appartments/{id}','update')->name('appartments.update');
    Route::delete('appartments/{id}','destroy')->name('appartments.delete');

});

Route::controller(BookingController::class)->group(function(){
    Route::get('bookings/create','create')->name('bookings.create');
    Route::post('bookings/store','store')->name('bookings.store');
    Route::get('bookings','index')->name('bookings.index');
    Route::get('bookings/{id}/edit','edit')->name('bookings.edit');
    Route::put('bookings/{id}','update')->name('bookings.update');
    Route::delete('bookings/{id}','destroy')->name('bookings.delete');

});

Route::controller(CustomerController::class)->group(function(){
    Route::get('customers/{id}/edit','edit')->name('customers.edit');
    Route::put('customers/{id}','update')->name('customers.update');
    Route::delete('customers/{id}','destroy')->name('customeres.dele');

    Route::get('overview','overview')->name('overview');
});

