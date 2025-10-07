<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/authors',[AuthorController::class, 'index']);

Route::get('/authors/{id}',[AuthorController::class, 'show']);

Route::post('/authors',[AuthorController::class, 'store']);

Route::put('/authors/{id}',[AuthorController::class, 'update']);
Route::patch('/authors/{id}',[AuthorController::class, 'patch']);

Route::delete('/authors/{id}',[AuthorController::class, 'delete']);