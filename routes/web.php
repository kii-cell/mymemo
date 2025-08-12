<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

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
Route::middleware('auth')->group(function () {
    //ゴミ箱一覧
    Route::get('memos/trash', [MemoController::class, 'trash'])->name('memos.trash');
    //ゴミ箱からの復元
    Route::put('memos/{id}/restore', [MemoController::class, 'restore'])->name('memos.restore');
    //完全削除
    Route::delete('memos/{id}/force-delete', [MemoController::class, 'forceDelete'])->name('memos.forceDelete');

    Route::resource('memos', MemoController::class);
});

require __DIR__ . '/auth.php';
