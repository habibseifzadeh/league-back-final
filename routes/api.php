<?php

use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('team')->group(function () {
    Route::get('/count', [TeamController::class, 'count']);
    Route::get('{team}/awards', [TeamController::class, 'awards']);
    Route::get('/allAwards', [TeamController::class, 'allAwards']);
});
Route::resource('team', TeamController::class);

Route::prefix('championship')->group(function () {
    Route::get('/schedule', [ChampionshipController::class, 'schedule']);
    Route::get('/scheduleTillDay/{day}', [ChampionshipController::class, 'scheduleTillDay']);
    Route::get('/truncate', [ChampionshipController::class, 'truncate']);
    Route::get('/count', [ChampionshipController::class, 'count']);
    Route::get('/oneDay/{day}', [ChampionshipController::class, 'oneDay']);
    Route::get('/days', [ChampionshipController::class, 'days']);
});
