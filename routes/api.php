<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FraisController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/getConnexion', [App\Http\Controllers\ControllerLogin::class, 'signIn']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::prefix('frais')->group(function () {
    Route::get('getFrais/{id_visiteur}', 'App\Http\Controllers\FraisController@getFraisVisiteur');
    Route::post('addFrais', 'App\Http\Controllers\FraisController@addFrais');
});
