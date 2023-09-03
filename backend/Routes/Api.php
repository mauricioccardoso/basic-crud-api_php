<?php

use App\Controllers\TaskController;
use App\Core\Abstractions\Route;

Route::get("/tasks", [TaskController::class, 'index']);
Route::post("/tasks/store", [TaskController::class, 'store']);
Route::post("/tasks/{id}/update", [TaskController::class, 'update']);
Route::post("/tasks/{id}/delete", [TaskController::class, 'delete']);