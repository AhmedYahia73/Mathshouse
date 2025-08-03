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


// Parents 
// Students +++++
// Teacher ++++
// Live ++++
// Report issues +++
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
        Route::get('/lists', 'lists');
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

    Route::controller(AcademicController::class)->prefix('live/academic')
    ->group(function(){
        Route::get('/lists', 'lists');
        Route::post('/', 'academic'); 
    });

    Route::controller(PrivateSession::class)->prefix('live/private')
    ->group(function(){
        Route::get('/', 'view');
        Route::get('/requests', 'private_requests');
        Route::put('/request_status/{id}', 'private_request_status');
    });

    Route::controller(CancelationController::class)->prefix('live/cancelation')
    ->group(function(){
        Route::get('/', 'cancelation');
        Route::post('/cancelation_filter', 'cancelation_filter');
        Route::put('/cancelation_status/{id}', 'cancelation_status');
    });

    Route::controller(TeacherSessionController::class)->prefix('live/teacher_session')
    ->group(function(){
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
    ->group(function(){
        Route::get('/', 'view'); 
        Route::put('/status/{id}', 'status'); 
        Route::post('/add', 'create'); 
        Route::post('/update/{id}', 'modify'); 
        Route::delete('/delete/{id}', 'delete'); 
    });

    Route::controller(PaymentController::class)->prefix('payment_request')
    ->group(function(){
        Route::get('/', 'payment_request'); 
    });
});