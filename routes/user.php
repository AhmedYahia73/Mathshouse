<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\User\Login\UserLoginController;
use App\Http\Controllers\Api\User\MyCourses\MyCoursesController;
use App\Http\Controllers\Api\User\UserLive\MyLivesController;
use App\Http\Controllers\Api\User\MyPackage\MyPackageController;
use App\Http\Controllers\Api\User\ScoreSheet\ScoreSheetController;

use App\Http\Controllers\Api\User\EducationHistory\QuizHistoryController;
use App\Http\Controllers\Api\User\EducationHistory\QuestionFlowController;
use App\Http\Controllers\Api\User\EducationHistory\DiaExamHistoryController;

use App\Http\Controllers\Api\User\Exam\QuestionController;
use App\Http\Controllers\Api\User\Exam\ExamController;
use App\Http\Controllers\Api\User\Exam\DiaExamController;
use App\Http\Controllers\Api\User\Exam\QuestionReportController;

use App\Http\Controllers\Api\User\Payment\WalletController;
use App\Http\Controllers\Api\User\Payment\PaymentHistoryController;

use App\Http\Controllers\Api\User\Profile\ProfileController;
use App\Http\Controllers\Api\User\Courses\CourseController;

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
        Route::get('my_ideas/{lesson_id}', 'my_ideas');
        Route::get('private_request_lists', 'private_request_lists');
        Route::get('private_request', 'private_request');
        Route::post('private_request_booking', 'private_request_booking');
    });
    
    Route::controller(MyPackageController::class)->prefix('my_packages')
    ->group(function(){
        Route::get('/lists', 'lists');
        Route::get('/', 'my_packages');
        Route::post('payment/{id}', 'payment_package');
        Route::get('packges/{id}', 'packges');
    });

    Route::controller(ScoreSheetController::class)->prefix('score_sheet')
    ->group(function(){
        Route::get('/lists', 'lists'); 
        Route::get('/', 'scoreSheet'); 
    });

    Route::controller(QuizHistoryController::class)->prefix('education/quiz')
    ->group(function(){
        Route::get('/quiz_history', 'quiz_history');
    });

    Route::controller(QuestionFlowController::class)
    ->group(function(){
        Route::get('/questions_parallel/{id}', 'questions_parallel');
        Route::get('/solve_parallel/{id}', 'solve_parallel');
        Route::post('/grade_solve_parallel/{id}', 'grade_solve_parallel');
        Route::get('/view_answer/{id}', 'view_answer');
        Route::get('/get_packages/{id}', 'get_packages');
    });

    Route::controller(DiaExamHistoryController::class)->prefix('education/diagnostic')
    ->group(function(){
        Route::get('/', 'view_dia'); 
        Route::get('/pdf/{id}', 'dia_pdf');
        Route::get('/dia_report/{id}', 'dia_report');
    });

    Route::controller(QuestionController::class)->prefix('question')
    ->group(function(){
        Route::get('/lists', 'lists');
        Route::post('/filter', 'question_filter');
        Route::get('/solve_question/{id}', 'solve_question');
        Route::post('/grade_question', 'grade_question');
    });

    Route::controller(ExamController::class)->prefix('exam')
    ->group(function(){
        Route::get('/lists', 'lists');
        Route::post('/filter', 'filter');
        Route::post('/solve_exam/{id}', 'solve_exam');
        Route::post('/grade_exam', 'grade_exam');
    });

    Route::controller(DiaExamController::class)->prefix('dia_exam')
    ->group(function(){
        Route::get('/lists', 'lists'); 
        Route::get('/show_exam/{course_id}', 'show_exam'); 
        Route::post('/grade_exam', 'grade_exam');
    });

    Route::controller(QuestionReportController::class)->prefix('question_report')
    ->group(function(){
        Route::post('/', 'question_report');
    });

    Route::controller(WalletController::class)->prefix('wallet')
    ->group(function(){
        Route::get('/history', 'history');
        Route::post('/recharge', 'recharge');
    });

    Route::controller(PaymentHistoryController::class)->prefix('payment_history')
    ->group(function(){
        Route::get('/', 'history');
        Route::get('/invoic/{id}', 'invoic');
    });

    Route::controller(ProfileController::class)->prefix('profile')
    ->group(function(){
        Route::get('/', 'view');
        Route::post('/update', 'update_profile');
    });

    Route::controller(CourseController::class)->prefix('courses')
    ->group(function(){
        Route::get('/', 'lists');
    });
});