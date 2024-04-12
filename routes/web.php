<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

use App\Http\Controllers\ApisControllers\APIFootballController;
use App\Http\Controllers\ScrapingControllers\ScrapingController;

use App\Livewire\Matches;


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


    Route::get('/test', [MainController::class, 'test'])->name('test');
    
    /* DashboardController routes */
    Route::get('/matches', Matches::class)->name('matches');
    /* DashboardController routes */

    /* APIFootballController routes */
    Route::get('/test-api', [APIFootballController::class, 'test'])->name('test-api');
    Route::get('/matches-by-date', [APIFootballController::class, 'matches_by_date'])->name('matches_by_date');
    /* APIFootballController routes */

    /* ScrapingController routes */
    Route::get('/test-scraper', [ScrapingController::class, 'test'])->name('test-scraper');
    Route::get('/bettingclosed-scraping', [ScrapingController::class, 'bettingclosed_scraping'])->name('bettingclosed-scraping');
    /* ScrapingController routes */


});
