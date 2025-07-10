<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\User\Login\UserLoginController;
use App\Http\Controllers\Api\User\MyCourses\MyCoursesController;
use App\Http\Controllers\Api\User\UserLive\MyLivesController;


Route::post('login', [UserLoginController::class, 'login']);
Route::post('logout', [UserLoginController::class, 'logout'])->middleware(['auth:sanctum', 'auth.MobileUser']);
Route::post('/forget_password', [UserLoginController::class, 'forget_password']);
// /user/forget_password
// /user/confirm_code
// /user/update_password
Route::post('/confirm_code', [UserLoginController::class, 'confirm_code']);
Route::post('/update_password', [UserLoginController::class, 'update_password']);

Route::any('/stu_sign_up_page',[UserLoginController::class, 'api_sign_up_page'])->name('api_sign_up_page');
Route::post('/stu_sign_up_add',[UserLoginController::class, 'api_sign_up_add'])->name('api_sign_up_add');

// /user/my_course
// /user/my_course
// /user/my_ideas/{lesson_id}
// /user/my_lives
// /user/lessons_live
// /user/private_request_lists
// /user/private_request
Route::middleware(['auth:sanctum', 'auth.MobileUser'])->group(function(){
    Route::get('/my_course', [MyCoursesController::class, 'my_course']);
    Route::get('/my_ideas/{lesson_id}', [MyCoursesController::class, 'my_ideas']);
    Route::post('/quiz_score', [MyCoursesController::class, 'quiz_score']);

    Route::controller(MyLivesController::class)->prefix('lives')
    ->group(function(){
        Route::get('my_lives', 'my_lives');
        Route::get('lessons_live', 'lessons_live');
        Route::get('private_request_lists', 'private_request_lists');
        Route::get('private_request', 'private_request');
    });
});