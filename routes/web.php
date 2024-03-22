<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::resource('task',TaskController::class);
Route::resource('empleado',EmpleadoController::class);
Route::get('datos-tabla', [TaskController::class, 'datosTablaTask'])->name('datos-tabla');
Route::get('datos-tabla-empleado', [EmpleadoController::class, 'datosTablaEmpleado'])->name('datos-tabla-empleado');
Route::get('/view-file/{filename}', [TaskController::class, 'showFile'])->name('view-file');
