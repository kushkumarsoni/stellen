<?php

use Illuminate\Support\Facades\Route;


Route::controller(App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/', 'index')->name('users');
    Route::post('/users/store',  'store')->name('users.store');
    Route::get('/users/fetchall',  'fetchAll')->name('users.fetchAll');
    Route::delete('/users/delete',  'delete')->name('users.delete');
    Route::get('/users/edit',  'edit')->name('users.edit');
    Route::post('/users/update',  'update')->name('users.update');
    Route::post('/users/countries',  'fetchCountry')->name('users.fetchCountry');
    Route::post('/users/states',  'fetchState')->name('users.fetchState');
    Route::post('/users/cities',  'fetchCity')->name('users.fetchCity');
});

