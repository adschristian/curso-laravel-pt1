<?php

use App\Http\Controllers\{
    SeasonsController,
    SeriesController,
    EpisodesController,
    AuthController,
    RegisterController
};
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/create', [SeriesController::class, 'create'])
    ->name('series.create')
    ->middleware('authenticator');
Route::post('/series/store', [SeriesController::class, 'store'])
    ->middleware('authenticator');
Route::delete('/series/destroy/{id}', [SeriesController::class, 'destroy'])
    ->middleware('authenticator');
Route::get('/series/{serieId}/seasons', [SeasonsController::class, 'index']);
Route::post('/series/{id}/edit', [SeriesController::class, 'update'])
    ->middleware('authenticator');

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index']);
Route::post('/seasons/{season}/episodes/watch', [EpisodesController::class, 'watch'])
    ->middleware('authenticator');

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/sign-up', [RegisterController::class, 'create']);
Route::post('/sign-up', [RegisterController::class, 'store']);

Route::get('/logout', function () {
    Auth::logout();

    return redirect('/login');
});
