<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\EncuestasController;
use App\Http\Controllers\HistoriasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiresource('usuarios', UsuariosController::class);
Route::apiresource('encuestas', EncuestasController::class);
Route::apiresource('reportes', ReportesController::class);
Route::apiresource('historias', HistoriasController::class);