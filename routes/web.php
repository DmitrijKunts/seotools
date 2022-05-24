<?php

use App\Http\Livewire\CheckIndex;
use App\Http\Livewire\Combine;
use App\Http\Livewire\Spintax;
use App\Http\Livewire\UrlIndex;
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
    return view('welcome');
})->name('welcome');

Route::get('/check-index', CheckIndex::class)->name('check-index');
Route::get('/url-index/{url:url}', UrlIndex::class)->name('url-index');
Route::get('/combinator', Combine::class)->name('combinator');
Route::get('/spintax', Spintax::class)->name('spintax');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
