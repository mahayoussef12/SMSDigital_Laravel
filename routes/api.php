<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\SmsLogsController;
use App\Http\Controllers\SmsTemplatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/home', function () {
    return response()->json(['message'=>'Hello, world']);
});
// routres pour authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// route pour CRUD Contact
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/contacts', [ContactsController::class, 'index']);
    Route::post('/contacts', [ContactsController::class, 'store']);
    Route::get('/contacts/{id}', [ContactsController::class, 'show']);
    Route::put('/contacts/{id}', [ContactsController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactsController::class, 'destroy']);
});

// route pour CRUD SmsTemplate
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/sms-templates', [SmsTemplatesController::class, 'index']);
    Route::post('/sms-templates', [SmsTemplatesController::class, 'store']);
    Route::get('/sms-templates/{id}', [SmsTemplatesController::class, 'show']);
    Route::put('/sms-templates/{id}', [SmsTemplatesController::class, 'update']);
    Route::delete('/sms-templates/{id}', [SmsTemplatesController::class, 'destroy']);
});

// route pour CRUD SmsLogTemplates
Route::get('/test-sms', [SmsLogsController::class, 'test']);
Route::post('/send-sms', [SmsLogsController::class, 'send']);


