<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\BorrowPolicyController;
use App\Http\Controllers\BorrowController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('categories', CategoryController::class)
    ->middleware('auth');

Route::resource('ebooks', EbookController::class)
    ->middleware('auth');

// Route::get('/ebooks/{ebook}/preview',[EbookController::class,'preview'])
//     ->name('ebooks.preview')
//     ->middleware('auth');

Route::resource('borrow-policies', BorrowPolicyController::class)
    ->middleware('auth');

Route::resource('borrows', BorrowController::class)
    ->middleware('auth');

Route::post('/ebooks/{ebook}/borrow',[BorrowController::class, 'borrow'])
    ->name('ebooks.borrow')
    ->middleware('auth');

Route::post('/borrows/{borrow}/return',[BorrowController::class, 'returnBook'])
    ->name('borrows.return')
    ->middleware('auth');

Route::get(
'/ebooks/{ebook}/preview',
[EbookController::class,'preview']
)->name('ebooks.preview')
->middleware('auth');


Route::get(
    '/ebooks/{ebook}/read',
    [EbookController::class,'read']
)->name('ebooks.read')
 ->middleware('auth');



require __DIR__.'/auth.php';
