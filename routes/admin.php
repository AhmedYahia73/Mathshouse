<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\Login\AdminLoginController;
use App\Http\Controllers\Api\Admin\Teacher\TeacherController;
use App\Http\Controllers\Api\Admin\Student\StudentController;
use App\Http\Controllers\Api\Admin\Live\SessionController;
use App\Http\Controllers\Api\Admin\Live\GroupController;

// Parents 
// Students +++++
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

    Route::controller(SessionController::class)->prefix('live/session')
    ->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(GroupController::class)->prefix('live/groups')
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
        Route::get('/payment_history/{id}', 'payment_history');
        Route::get('/wallet_balance/{id}', 'wallet_balance');
        Route::post('/charge_wallet', 'charge_wallet'); 
        Route::get('/academic_list/{id}', 'academic_list');
        Route::post('/academic_list_add', 'academic_list_add');
        Route::post('/lives_view', 'lives_view');
        Route::post('/live_attend', 'live_attend');
    });
});