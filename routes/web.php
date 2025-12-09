<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PoemController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Games Routes
Route::prefix('games')->name('games.')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('index');
    Route::get('/puzzle', [GameController::class, 'puzzle'])->name('puzzle');
    Route::get('/tebakkata', [GameController::class, 'tebakKata'])->name('tebakkata');
    Route::get('/memorycard', [GameController::class, 'memoryCard'])->name('memorycard');
    Route::get('/blockblast', [GameController::class, 'blockBlast'])->name('blockblast');
    Route::get('/tictactoe', [GameController::class, 'ticTacToe'])->name('tictactoe');
    Route::get('/snake', [GameController::class, 'snake'])->name('snake');
});

// Poem Route
Route::get('/poem', [PoemController::class, 'index'])->name('poem');

// Gallery Route
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Message Route
Route::get('/message', [MessageController::class, 'index'])->name('message');

