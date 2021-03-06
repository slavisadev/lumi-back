<?php

use App\Http\Controllers\ResultsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/search/{term}', [SearchController::class, 'execute']);
Route::post('/vote', [VoteController::class, 'execute']);
Route::post('/score', [ResultsController::class, 'store']);
Route::get('/results', [ResultsController::class, 'index']);
