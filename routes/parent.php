<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Parent\ParentLoginController;
use App\Http\Controllers\Api\Parent\AddStudent\AddStudentController;

use App\Http\Controllers\Api\Parent\Package\PackageController;
use App\Http\Controllers\Api\Parent\MyCourses\MyCouresController;
use App\Http\Controllers\Api\Parent\ScoreSheet\ScoreSheetController;
use App\Http\Controllers\Api\Parent\Payment\PaymentController;
use App\Http\Controllers\Api\Parent\Payment\WalletController;

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

    Route::controller(PackageController::class)
    ->prefix('packages')->group(function(){
        Route::post('/my_packages', 'my_packages');
        Route::post('/packages/{id}', 'packages');
        Route::post('/lists', 'lists');
        Route::post('/payment_package/{id}', 'payment_package');
    });

    Route::controller(MyCouresController::class)
    ->prefix('my_courses')->group(function(){
        Route::post('/', 'my_course'); 
    });

    Route::controller(PaymentController::class)
    ->prefix('payment')->group(function(){
        Route::post('/history', 'history'); 
        Route::post('/invoic/{id}', 'invoic'); 
    });

    Route::controller(WalletController::class)
    ->prefix('wallet_payment')->group(function(){
        Route::post('/history', 'history'); 
        Route::post('/recharge', 'recharge'); 
    });

    Route::controller(ScoreSheetController::class)
    ->prefix('score_sheet')->group(function(){
        Route::post('/lists', 'lists'); 
        Route::post('/', 'scoreSheet'); 
    });
});