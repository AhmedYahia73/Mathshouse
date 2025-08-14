<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Parent\ParentLoginController;
use App\Http\Controllers\Api\Parent\AddStudent\AddStudentController;

Route::post('login', [ParentLoginController::class, 'login']); 
Route::post('/forget_password', [ParentLoginController::class, 'forget_password']);
Route::post('/confirm_code', [ParentLoginController::class, 'confirm_code']);
Route::post('/update_password', [ParentLoginController::class, 'update_password']);
 
Route::middleware(['auth:sanctum', 'auth.MobileParent'])->group(function(){
    Route::controller(AddStudentController::class)
    ->prefix('student')->group(function(){
        Route::post('/add', 'add_student');
        Route::post('/check_code', 'check_code');
    });
});