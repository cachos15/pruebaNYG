<?php

use App\Http\Controllers\documentoController;
use App\Http\Controllers\visitanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('visitante',visitanteController::class);
Route::resource('documento',documentoController::class);
