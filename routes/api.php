<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\SpecialistController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('userregister', [UserController::class, 'userregister']);
Route::post('userlogin', [UserController::class, 'userlogin']);
Route::middleware('auth:api')->post('/userlogout', 'PassportAuthController@logout')->name('api.auth.logout');
Route::post('userlogout', [UserController::class, 'userlogout']);
Route::post('expertregister', [ExpertController::class, 'expertregister']);
Route::post('expertlogin', [ExpertController::class, 'expertlogin']);
Route::post('expertlogout', [ExpertController::class, 'expertlogout']);
Route::get('listexperts', [ExpertController::class, 'listexperts']);   //list of experts
Route::get('profileExpeert/{id}', [ExpertController::class, 'profileExpeert']);  //profile of expert
Route::get('listspecialist', [SpecialistController::class, 'listspecialist']); //list of specialist