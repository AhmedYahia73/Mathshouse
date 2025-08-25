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
use App\Http\Controllers\Api\Admin\Live\AcademicController;
use App\Http\Controllers\Api\Admin\Live\PrivateSession;
use App\Http\Controllers\Api\Admin\Live\CancelationController;
use App\Http\Controllers\Api\Admin\Live\TeacherSessionController;

use App\Http\Controllers\Api\Admin\ReportIssue\Question\QReportList;
use App\Http\Controllers\Api\Admin\ReportIssue\Question\QReportAction;
use App\Http\Controllers\Api\Admin\ReportIssue\Video\VReportList;
use App\Http\Controllers\Api\Admin\ReportIssue\Video\VReportAction;

use App\Http\Controllers\Api\Admin\Payment\PaymentMethodController;
use App\Http\Controllers\Api\Admin\Payment\PaymentController;

use App\Http\Controllers\Api\Admin\Reports\LiveReportController;
use App\Http\Controllers\Api\Admin\Reports\GradeReportController;
use App\Http\Controllers\Api\Admin\Reports\PaymentReportController;
use App\Http\Controllers\Api\Admin\Reports\CourseReportController;
use App\Http\Controllers\Api\Admin\Reports\ExamReportController;
use App\Http\Controllers\Api\Admin\Reports\ScoreSheetQuizReportController;
use App\Http\Controllers\Api\Admin\Reports\ScoreSheetExamReportController;

use App\Http\Controllers\Api\Admin\Notification\NotificationController;

use App\Http\Controllers\Api\Admin\Parent\ParentController;

use App\Http\Controllers\Api\Admin\Package\PackageController;


// Parents ++++
// Students +++++
// Teacher ++++
// Live ++++
// Report issues +++
// Payment +++
// Reports +++
// Teacher sessions +++

Route::post('login', [AdminLoginController::class, 'login']);

Route::middleware(['auth:sanctum', 'auth.MobileAdmin'])->group(function(){
    Route::controller(TeacherController::class)->prefix('teacher')
    ->middleware('can:Users')->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(SessionController::class)->prefix('live/session')
    ->middleware('can:Live')->group(function(){
        Route::get('/', 'view');
        Route::get('/lists', 'lists');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(GroupController::class)->prefix('live/groups')
    ->middleware('can:Live')->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(StudentController::class)->prefix('student')
    ->middleware('can:Users')->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete'); 
        Route::get('/payment_history/{id}', 'payment_history');
        Route::get('/wallet_balance/{id}', 'wallet_balance');
        Route::post('/charge_wallet', 'charge_wallet')->middleware('can:Wallet'); 
        Route::get('/academic_list/{id}', 'academic_list');
        Route::post('/academic_list_add', 'academic_list_add');
        Route::post('/lives_view', 'lives_view');
        Route::post('/live_attend', 'live_attend');
    });

    Route::controller(AcademicController::class)->prefix('live/academic')
    ->middleware('can:Live')->group(function(){
        Route::get('/lists', 'lists');
        Route::post('/', 'academic'); 
    });

    Route::controller(PrivateSession::class)->prefix('live/private')
    ->middleware('can:Live')->group(function(){
        Route::get('/', 'view');
        Route::get('/requests', 'private_requests');
        Route::put('/request_status/{id}', 'private_request_status');
    });

    Route::controller(CancelationController::class)->prefix('live/cancelation')
    ->middleware('can:Live')->group(function(){
        Route::get('/', 'cancelation');
        Route::post('/cancelation_filter', 'cancelation_filter');
        Route::put('/cancelation_status/{id}', 'cancelation_status');
    });

    Route::controller(TeacherSessionController::class)->prefix('live/teacher_session')
    ->middleware('can:Live')->group(function(){
        Route::get('/', 'view');
        Route::get('/lists', 'lists');
        Route::post('/filter_teacher_session', 'filter_teacher_session');
    });

    Route::controller(QReportList::class)->prefix('report_issue/q_reportlist')
    ->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(QReportAction::class)->prefix('report_issue/q_report_action')
    ->group(function(){
        Route::get('/', 'view'); 
        Route::put('/status/{id}', 'status'); 
    });

    Route::controller(VReportList::class)->prefix('report_issue/v_reportlist')
    ->group(function(){
        Route::get('/', 'view');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });

    Route::controller(VReportAction::class)->prefix('report_issue/v_report_action')
    ->group(function(){
        Route::get('/', 'view'); 
        Route::put('/status/{id}', 'status'); 
    });

    Route::controller(PaymentMethodController::class)->prefix('payment_method')
    ->middleware('can:Payment')->group(function(){
        Route::get('/', 'view'); 
        Route::put('/status/{id}', 'status'); 
        Route::post('/add', 'create'); 
        Route::post('/update/{id}', 'modify'); 
        Route::delete('/delete/{id}', 'delete'); 
    });

    Route::controller(PaymentController::class)->prefix('payment_request')
    ->middleware('can:Payment')->group(function(){
        Route::get('/', 'payment_request'); 
        Route::put('/reject_request/{id}', 'reject_request')->middleware('can:AcceptPayment'); 
        Route::put('/approve_request/{id}', 'approve_request')->middleware('can:AcceptPayment');
        Route::get('/wallet', 'wallet');
        Route::put('/approve_wallet/{id}', 'approve_wallet')->middleware('can:AcceptPayment');
        Route::put('/rejected_wallet/{id}', 'rejected_wallet')->middleware('can:AcceptPayment');
    });

    Route::controller(LiveReportController::class)->prefix('reports/live')
    ->middleware('can:Reports')->group(function(){
        Route::get('/', 'view');  
        Route::post('/filter', 'filter');  
    });

    Route::controller(GradeReportController::class)->prefix('reports/grade')
    ->middleware('can:Reports')->group(function(){
        Route::get('/', 'view');  
        Route::post('/filter', 'filter');  
    });

    Route::controller(PaymentReportController::class)->prefix('reports/payment')
    ->middleware('can:Reports')->group(function(){
        Route::get('/', 'view');  
        Route::post('/filter', 'filter');  
    });

    Route::controller(CourseReportController::class)->prefix('reports/courses')
    ->middleware('can:Reports')->group(function(){
        Route::get('/', 'view');  
        Route::post('/filter', 'filter');  
    });

    Route::controller(ExamReportController::class)->prefix('reports/exam')
    ->middleware('can:Reports')->group(function(){
        Route::get('/', 'lists');  
        Route::post('/exam_questions', 'exam_questions');  
    });

    Route::controller(ScoreSheetQuizReportController::class)->prefix('reports/score_sheet/quiz')
    ->middleware('can:Reports')->group(function(){
        Route::get('/students', 'students');  
        Route::get('/quiz_list/{user_id}', 'quiz_list');
        Route::get('/quiz_mistakes/{id}', 'quiz_mistakes');
        Route::get('/quiz_report/{id}', 'quiz_report');
        Route::post('/generatePdf', 'generatePdf');
        Route::post('/generateAnsPdf', 'generateAnsPdf');
    });

    Route::controller(ScoreSheetExamReportController::class)->prefix('reports/score_sheet/exam')
    ->middleware('can:Reports')->group(function(){ 
        Route::get('/exam_list/{user_id}', 'exam_list');
        Route::get('/exam_mistakes/{id}', 'exam_mistakes');
        Route::post('/generatePdf', 'generatePdf');
        Route::post('/generateAnsPdf', 'generateAnsPdf');
    });

    Route::controller(ParentController::class)->prefix('parent')
    ->middleware('can:Users')->group(function(){ 
        Route::get('/', 'view')->name('parent_view');
        Route::post('/add', 'create')->name('parent_add');
        Route::post('/update/{id}', 'update')->name('parent_update');
        Route::delete('/delete/{id}', 'delete')->name('parent_delete');
    });

    Route::controller(PackageController::class)->prefix('package')
    ->middleware('can:Packages')->group(function(){ 
        Route::get('/', 'view');
        Route::post('/update/{id}', 'modify'); 
    });
    

    Route::controller(NotificationController::class)->middleware('can:Notifictions')
    ->prefix('notifictions')->group(function(){
        Route::get('/', 'view');  
        Route::post('/add', 'create');  
        Route::post('/update/{id}', 'modify');  
        Route::delete('/delete/{id}', 'delete');  
    });
});