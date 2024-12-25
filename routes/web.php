<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [ClassesController::class, 'index'])->name('home');

Route::get('/events', [EventController::class, 'index'])->name('event.index');

Route::get('/registration', [MemberController::class, 'create'])->name('member.create');
Route::post('/registration', [MemberController::class, 'store'])->name('member.store');

Route::get('/members', [MemberController::class, 'index'])->name('member.index');

Route::get('/class', [ClassesController::class, 'index'])->name('class.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
