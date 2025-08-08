<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create')->middleware('auth');
Route::post('questions', [QuestionController::class, 'store'])->name('questions.store')->middleware('auth');
Route::get('questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit')->middleware('auth');
Route::put('questions/{question}', [QuestionController::class, 'update'])->name('questions.update')->middleware('auth');
Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy')->middleware('auth');

Route::post('/answers/{question}', [AnswerController::class, 'store'])->name('answers.store')->middleware('auth');

// Blog routes
Route::resource('blog', BlogController::class);

require __DIR__.'/auth.php';
