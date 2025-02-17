<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoneyMovementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
	dd( base_path(). '/../public/storage/',env('APP_URL'),storage_path('app'));
});

Route::view('/public','home')->name('home');

Route::get('/', [HomeController::class,'index']);

Route::view('/login','Auth.login')->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class,'logout']);
Route::get('/logout', [LoginController::class,'logoutGet']);

Route::view('/password/reset','Auth.passwords.email')->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}',[ForgotPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class,'reset'])->name('password.update');

Route::view('/home','home')->middleware('auth');

Route::resource('/contact',ContactController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/users',UserController::class);
    Route::post('/users/table', [UserController::class,'getDataTable']);
    Route::resource('/roles',RolController::class);
    Route::post('/roles/table', [RolController::class,'getDataTable']);
    Route::get('/roles/users/{id}', [RolController::class,'getUsersRol']);
    
    Route::resource('/permission',PermissionController::class);
    Route::post('/permission/table', [PermissionController::class,'getDataTable']);

    Route::post('/roles/permission/update', [PermissionController::class,'updaterolpermission'])->name('updaterolpermission');

    Route::resource('/client',ClientController::class);
    Route::post('/client/table', [ClientController::class,'getDataTable']);
    Route::resource('/provider',ProviderController::class);
    Route::post('/provider/table', [ProviderController::class,'getDataTable']);

    Route::resource('/movement',MoneyMovementController::class);

    Route::resource('/account',BankAccountController::class);
    Route::post('/account/table', [BankAccountController::class,'getDataTable']);
});