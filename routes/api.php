<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\VisiteurController;

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
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('frais')->group(function () {
    Route::get('getFrais/{id_visiteur}', 'App\Http\Controllers\FraisController@getFraisVisiteur');
    Route::get('getUnFrais/{id_frais}', 'App\Http\Controllers\FraisController@getUnFrais');
    Route::get('getEtats', 'App\Http\Controllers\FraisController@getEtats');
    Route::get('getFraisMois/{mois}', 'App\Http\Controllers\FraisController@getFraisMois');
    Route::get('getSumFraisMois/{mois}', 'App\Http\Controllers\FraisController@getSumFraisMois');
    Route::get('getSumFraisMois/{mois}', 'App\Http\Controllers\FraisController@getSumFraisMois');
    Route::get('getNbHFParFrais/{id_frais}', 'App\Http\Controllers\FraisController@getNbHFParFrais');
    Route::post('addFrais', 'App\Http\Controllers\FraisController@addFrais');
    Route::post('updateFrais', 'App\Http\Controllers\FraisController@updateFrais');
    Route::post('deleteFrais', 'App\Http\Controllers\FraisController@deleteFrais');
});
Route::prefix('visiteur')->group(function () {
    Route::get('getVisiteurVille/{ville_visiteur}', 'App\Http\Controllers\VisiteurController@getVisiteurVille');
    Route::get('getVisiteurNom/{nom}', 'App\Http\Controllers\VisiteurController@getVisiteurNom');
    Route::post('addVisiteur', 'App\Http\Controllers\VisiteurController@addVisiteur');
    Route::post('updateVisiteur', 'App\Http\Controllers\VisiteurController@updateVisiteur');
    Route::get('getVisiteurSansFrais', 'App\Http\Controllers\VisiteurController@getVisiteurSansFrais');
});

Route::prefix('praticien')->group(function () {
    Route::get('getPraticienByNom/{nom_praticien}', 'App\Http\Controllers\PraticienController@getPraticienByNom');
    Route::get('getPraticienByType/{id_type_praticien}', 'App\Http\Controllers\PraticienController@getPraticienByType');
    Route::post('addInvitation', 'App\Http\Controllers\PraticienController@addInvitation');
    Route::post('updateInvitation', 'App\Http\Controllers\PraticienController@updateInvitation');
    Route::post('deleteInvitation', 'App\Http\Controllers\PraticienController@deleteInvitation');
});
