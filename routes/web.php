<?php

use App\Http\Controllers\{SeasonsController, SeriesController, EpisodesController};
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
Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
Route::post('/series/store', [SeriesController::class, 'store']);
Route::delete('/series/destroy/{id}', [SeriesController::class, 'destroy']);
Route::get('/series/{serieId}/seasons', [SeasonsController::class, 'index']);
Route::post('/series/{id}/edit', [SeriesController::class, 'update']);

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index']);
Route::post('/seasons/{season}/episodes/watch', [EpisodesController::class, 'watch']);
