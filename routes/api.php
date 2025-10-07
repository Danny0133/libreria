<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Autores
Route::get('/authors',[AuthorController::class, 'index']);
Route::get('/authors/{id}',[AuthorController::class, 'show']);
Route::post('/authors',[AuthorController::class, 'store']);
Route::put('/authors/{id}',[AuthorController::class, 'update']);
Route::patch('/authors/{id}',[AuthorController::class, 'patch']);
Route::delete('/authors/{id}',[AuthorController::class, 'delete']);

//Libros
Route::get('/books',[BookController::class, 'index']);
Route::get('/books/{id}',[BookController::class, 'show']);
Route::post('/books',[BookController::class, 'store']);
Route::put('/books/{id}',[BookController::class, 'update']);
Route::patch('/books/{id}',[BookController::class, 'patch']);
Route::delete('/books/{id}',[BookController::class, 'delete']);