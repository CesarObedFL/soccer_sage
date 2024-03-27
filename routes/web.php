<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ApisControllers\APIFootballController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /* APIFootballController routes */
    Route::get('/test-api', [APIFootballController::class, 'test'])->name('test');
    Route::get('/matches-by-date', [APIFootballController::class, 'matches_by_date'])->name('matches_by_date');
    /* APIFootballController routes */

});
