<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/todolist', [TaskController::class, 'index']);
Route::get('/todolist/{task}', [TaskController::class, 'show']);
Route::post('/todolist', [TaskController::class, 'store']);
Route::put('/todolist/{task}', [TaskController::class, 'update']);
Route::delete('/todolist/{task}', [TaskController::class, 'destroy']);
