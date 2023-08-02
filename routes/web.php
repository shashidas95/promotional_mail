<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\TokenVerificationMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/userRegistration', [UserController::class, 'UserRegistration']);
Route::post('/userLogin', [UserController::class, 'UserLogin']);
Route::post('/sendOtp', [UserController::class, 'SendOtp']);
Route::post('/verifyOtp', [UserController::class, 'VerifyOtp']);
Route::post('/resetPassword', [UserController::class, 'ResetPassword'])
    ->middleware([TokenVerificationMiddleware::class]);

//Route::get('/sendEmail', [CodeController::class, 'generateVerificationCodeForUser']);


Route::post('/createCustomer', [CustomerController::class, 'CreateCustomer']);
Route::post('/listCustomer', [CustomerController::class, 'ListCustomer']);
Route::post('/sendEmail', [CustomerController::class, 'sendPromotionalEmails']);


Route::post('/updateCustomer', [CustomerController::class, 'UpdateCustomer']);
Route::post('/deleteCustomer', [CustomerController::class, 'DeleteCustomer']);
