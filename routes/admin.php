<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\Login\AdminLoginController;
use App\Http\Controllers\Api\Admin\Teacher\TeacherController;
use App\Http\Controllers\Api\Admin\Student\StudentController;

// Parents 
// Students 
// Teacher ++++
// Live
// Report issues 
// Payment 
// Reports
// Teacher sessions

// MobileUser

Route::post('login', [AdminLoginController::class, 'login']);

Route::middleware(['auth:sanctum', 'auth.MobileAdmin'])->group(function(){
    Route::controller(TeacherController::class)->prefix('teacher')
    ->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(StudentController::class)->prefix('student')
    ->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });
});