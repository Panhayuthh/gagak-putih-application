<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/home', function () {
//     return view('home');
// })->name('home');

Route::get('/home', [ClassesController::class, 'index'])->name('home');
// Route::get('/event', function () {
//     return view('admin.events');
// })->name('admin.event');
// Route::get('/member', function(){
//     return view('admin.members');
// })->name('admin.member');

Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');

    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('{event}/update', [EventController::class, 'update'])->name('update');
        Route::delete('{event}', [EventController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('members')->name('members.')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('index');
    Route::get('/search', [MemberController::class, 'search'])->name('search');

    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::post('/', [MemberController::class, 'store'])->name('store');
        Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit');
        Route::put('/{member}/update', [MemberController::class, 'update'])->name('update');
        Route::delete('/{member}', [MemberController::class, 'destroy'])->name('destroy');
        Route::put('/{member}/approve', [MemberController::class, 'approve'])->name('approve');
    });
});

Route::get('/registration', [MemberController::class, 'create'])->name('member.create');
Route::post('/registration', [MemberController::class, 'store'])->name('member.store');


Route::prefix('schedule')->name('schedule.')->group(function () {
    Route::get('/', [ClassesController::class, 'index'])->name('index');
    
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::post('/', [ClassesController::class, 'store'])->name('store');
        Route::put('{class}/update', [ClassesController::class, 'update'])->name('update');
        Route::delete('{class}', [ClassesController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
//     Route::get('/events', [EventController::class, 'index'])->name('events.index');
//     Route::post('/events', [EventController::class, 'store'])->name('events.store');
//     Route::put('/events/{event}/update', [EventController::class, 'update'])->name('events.update');
//     Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
// });

require __DIR__.'/auth.php';
