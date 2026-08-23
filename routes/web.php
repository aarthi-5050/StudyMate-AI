<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('landing');
});

Route::prefix('Admin')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

   

    Route::post('/login-check', [AuthController::class, 'loginCheck'])
        ->name('loginCheck');

    
    Route::post('/send-otp',[AuthController::class,'sendOtp'])->name('sendOtp');

    Route::post('/verify-otp',[AuthController::class,'verifyOtp'])->name('verifyOtp');

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');

Route::post('/forgot-password-save', [AuthController::class, 'forgotPasswordSave'])
    ->name('forgot.password.save');

Route::get('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('reset.password');

Route::post('/update-password', [AuthController::class, 'updatePassword'])
    ->name('password.update');

Route::get('/notes',
        [AdminController::class,'notes'])
        ->name('notes');

    Route::post('/notes/store',
        [AdminController::class,'store'])
        ->name('notes.store');

    Route::post('/notes/update/{id}',
        [AdminController::class,'update'])
        ->name('notes.update');

    Route::get('/notes/delete/{id}',
        [AdminController::class,'delete'])
        ->name('notes.delete');

    // Documents
Route::get('/documents', [AdminController::class,'documents'])
    ->name('documents');

Route::post('/documents/store', [AdminController::class,'documentStore'])
    ->name('documents.store');

Route::post('/documents/update/{id}', [AdminController::class,'documentUpdate'])
    ->name('documents.update');

Route::get('/documents/delete/{id}', [AdminController::class,'documentDelete'])
    ->name('documents.delete');

Route::get('/smart-chat',[AdminController::class,'smartChat'])
    ->name('smart.chat');

Route::post('/smart-chat/send',[AdminController::class,'sendMessage'])
    ->name('smart.chat.send');

Route::get('/chat-history', [AdminController::class, 'chatHistory'])
    ->name('chat.history');

Route::get('/chat-history/delete/{id}', [AdminController::class, 'deleteChat'])
    ->name('chat.delete');

Route::get('/profile', [AdminController::class,'profile'])
    ->name('profile');

Route::post('/profile/update', [AdminController::class,'profileUpdate'])
    ->name('profile.update');

Route::get('/chat-history/download',
    [AdminController::class, 'downloadChatHistory'])
    ->name('chat.download');

Route::get('/invoice',[AdminController::class,'invoice'])
    ->name('invoice');

    

        Route::get('/test', function () {
    return 'StudyMateAI is working!';
});

Route::middleware('admin')->group(function(){

    Route::get('/dashboard',[AuthController::class,'dashboard'])
        ->name('dashboard');

    Route::get('/logout',[AuthController::class,'logout'])
        ->name('logout');

});


});