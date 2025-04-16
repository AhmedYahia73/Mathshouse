<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizzeController;
use App\Http\Controllers\Admin\DiagnosticExamController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\LiveController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\Ad_ReportsController;
use App\Http\Controllers\Admin\TeacherReportController;

use App\Http\Controllers\Visitor\CoursesController;
use App\Http\Controllers\Visitor\V_ExamController;

use App\Http\Controllers\Student\Stu_MyCourseController;
use App\Http\Controllers\Student\Stu_LiveController;
use App\Http\Controllers\Student\ScoreController;

use App\Http\Controllers\DomPdfController;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Student\payment\PaymentPaymobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(TeacherReportController::class)
->prefix('TeacherReport')->group(function(){
    Route::get('/', 'data')->name('teacher_report');
    Route::get('/Filter', 'filter')->name('teacher_report_filter');
});
Route::post('/question_type', [QuestionController::class, 'question_type'])->name('question_type');
Route::get('/quize_data', [QuizzeController::class, 'quize_data'])->name('quize_data');
Route::get('/dia_exam_data', [DiagnosticExamController::class, 'dia_exam_data'])->name('dia_exam_data');
Route::get('/exam_del_q', [DiagnosticExamController::class, 'exam_del_q'])->name('exam_del_q');
Route::get('/exam_add_q', [DiagnosticExamController::class, 'exam_add_q'])->name('exam_add_q');
Route::get('/dia_filter_question', [DiagnosticExamController::class, 'dia_filter_question'])->name('dia_filter_question');
Route::get('/lessons_api', [LessonController::class, 'lessons'])->name('lessons');
Route::get('/quize_del_q', [QuizzeController::class, 'quize_del_q'])->name('quize_del_q');
Route::get('/quize_add_q', [QuizzeController::class, 'quize_add_q'])->name('quize_add_q');
Route::get('/buy_chapters', [CoursesController::class, 'buy_chapters'])->name('buy_chapters');
Route::get('/api_courses_data', [CoursesController::class, 'api_courses_data'])->name('api_courses_data');
Route::get('/api_chechout_description', [CoursesController::class, 'api_chechout_description'])->name('api_chechout_description');
Route::get('/sel_duration_course', [CoursesController::class, 'sel_duration_course'])->name('sel_duration_course');
Route::get('/exam_data', [ExamController::class, 'exam_data'])->name('exam_data');
Route::get('/ScoreSheet/Edit',[ExamController::class, 'scoreEdit'])->name('scoreEdit'); 
Route::get('/ad_lesson_score_sheet', [Ad_ReportsController::class, 'ad_lesson_score_sheet'])->name('ad_lesson_score_sheet');

Route::middleware('throttle:60,1')->get('/api_timer', [V_ExamController::class, 'api_timer'])->name('api_timer');

Route::get('/private_req', [Stu_LiveController::class, 'private_req_api'])->name('private_req_api');
Route::get('/private_req_book', [Stu_LiveController::class, 'private_req_book_api'])->name('private_req_book_api');
Route::get('/stu_sessions_api', [Stu_LiveController::class, 'stu_sessions_api'])->name('stu_sessions_api');
Route::get('/lesson_score_sheet', [ScoreController::class, 'lesson_score_sheet'])->name('lesson_score_sheet');
Route::post('/course_score_sheet', [ScoreController::class, 'course_score_sheet'])->name('course_score_sheet')->middleware(['auth:sanctum']);
Route::post('/student_courses', [ScoreController::class, 'student_courses'])->name('student_courses')->middleware(['auth:sanctum']);

Route::get('/add_stu_academic', [UserController::class, 'add_stu_academic'])->name('add_stu_academic');
Route::get('/api_stu_academic', [UserController::class, 'api_stu_academic'])->name('api_stu_academic');
Route::get('/stu_search_api', [UserController::class, 'stu_search_api'])->name('stu_search_api');
Route::get('/teacher_search_api', [UserController::class, 'teacher_search_api'])->name('teacher_search_api');

Route::get('/package_stu_search', [PackagesController::class, 'package_stu_search'])->name('package_stu_search');
Route::get('/stu_package_add', [PackagesController::class, 'stu_package_add'])->name('stu_package_add');

Route::get('/report_video_q_api', [Stu_MyCourseController::class, 'report_video_q_api'])->name('report_video_q_api');
Route::get('/report_video', [Stu_MyCourseController::class, 'report_video_api'])->name('report_video_api');
Route::get('/report_q_video', [Stu_MyCourseController::class, 'report_q_video_api'])->name('report_q_video_api');
Route::get('/api_report_question', [Stu_MyCourseController::class, 'api_report_question'])->name('api_report_question');

Route::get('/teacher_courses', [LiveController::class, 'teacher_courses'])->name('teacher_courses');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});
   Route::controller(Ad_ReportsController::class)->group(function(){
             Route::post('/Report/ScoreSheet/generatePdf','generatePdf')->name('generatePdf');
            });

Route::prefix('v1')->group(function () {

    Route::get('/users', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users-list', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users', function (Request $request) {
        return app(SampleUserApi::class)->create($request);
    });

    Route::get('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->get($id);
    });

    Route::put('/users/{id}', function ($id, Request $request) {
        return app(SampleUserApi::class)->update($id, $request);
    });

    Route::delete('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->delete($id);
    });


    Route::get('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles-list', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->create($request);
    });

    Route::get('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->get($id);
    });

    Route::put('/roles/{id}', function ($id, Request $request) {
        return app(SampleRoleApi::class)->update($id, $request);
    });

    Route::delete('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->delete($id);
    });

    Route::post('/roles/{id}/users', function (Request $request, $id) {
        $request->merge(['id' => $id]);
        return app(SampleRoleApi::class)->usersDatatableList($request);
    });

    Route::delete('/roles/{id}/users/{user_id}', function ($id, $user_id) {
        return app(SampleRoleApi::class)->deleteUser($id, $user_id);
    });



    Route::get('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions-list', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->create($request);
    });

    Route::get('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->get($id);
    });

    Route::put('/permissions/{id}', function ($id, Request $request) {
        return app(SamplePermissionApi::class)->update($id, $request);
    });

    Route::delete('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->delete($id);
    });
});


Route::post('login', [ApiController::class, 'login'])->middleware('limit.sessions')->name('login');
Route::post('logout', [ApiController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::any('/stu_sign_up_page',[ApiController::class, 'api_sign_up_page'])->name('api_sign_up_page');
Route::post('/stu_sign_up_add',[ApiController::class, 'api_sign_up_add'])->name('api_sign_up_add');

Route::post('/forget_password', [ApiController::class, 'forget_password'])->name('forget_password');
Route::post('/confirm_code', [ApiController::class, 'confirm_code'])->name('confirm_code');
Route::post('/update_password', [ApiController::class, 'update_password'])->name('update_password');

Route::get('/Quiz/Report/{id}', [DomPdfController::class, 'quizze_report'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->prefix('MobileStudent')->group(function(){
    Route::controller(ApiController::class)->prefix('ApiMyCourses')->group(function(){
        Route::get('/stu_courses','api_stu_my_courses')->name('api_stu_my_courses');
        Route::get('/stu_chapters','api_stu_my_chapter')->name('api_stu_my_chapter');
        Route::get('/stu_lessons','api_stu_lesson')->name('api_stu_lesson');
        Route::get('/stu_exam/{id}','api_stu_exam')->name('api_stu_exam');
        Route::get('/stu_live','api_stu_live')->name('api_stu_live');
        Route::get('/stu_exam_filter','api_stu_exam_filter')->name('api_stu_exam_filter');
        Route::any('/stu_filter_exam_process','api_filter_exam')->name('api_filter_exam');
        Route::get('/stu_question_history','api_question_history')->name('api_question_history');
        Route::get('/stu_question_filter','api_question_filter')->name('api_question_filter');
        Route::get('/stu_dia_exam_filter','api_dia_exam_filter')->name('api_dia_exam_filter');
        Route::any('/stu_dia_exam/{id}','api_dia_exam')->name('api_dia_exam');
        Route::get('/stu_history','api_history')->name('api_history');
        Route::any('/stu_question_mistake/{id}','api_question_mistake')->name('api_question_mistake');
        Route::get('/stu_profile_data','api_profile_data')->name('api_profile_data');
        Route::post('/stu_profile_data','api_profile_date_edit')->name('api_profile_date_edit');
        Route::post('/update_stu_image','update_stu_image')->name('update_stu_image');
        Route::get('/stu_quiz/{id}','api_quiz')->name('api_quiz');
        Route::post('/stu_check_quiz','api_check_quiz')->name('api_check_quiz');
        Route::get('/stu_quiz_mistakes/{id}','stu_quiz_mistakes')->name('stu_quiz_mistakes');
        Route::post('/stu_quiz_grade','api_quiz_grade')->name('api_quiz_grade');
        Route::get('/stu_profile_edit','api_profile_edit')->name('api_profile_edit');
        Route::get('/stu_link_live/{id}','api_link_live')->name('api_link_live');
        Route::get('/stu_exam_grade','api_exam_grade')->name('api_exam_grade');
        Route::any('/stu_dia_exam_grade','api_dia_exam_grade')->name('api_dia_exam_grade');
        Route::any('/stu_exam_mistakes/{id}','api_exam_mistakes')->name('api_exam_mistakes');
        Route::get('/stu_packages','api_packages')->name('api_packages');
        Route::get('/stu_dia_grade','api_dia_grade')->name('api_dia_grade');
        Route::get('/stu_payment_methods','api_payment_methods')->name('api_payment_methods');
        Route::post('/proccess_student_wallet','proccess_student_wallet')->name('proccess_student_wallet');
        Route::get('/student_hestory_wallet','student_hestory_wallet')->name('student_hestory_wallet');
        Route::post('/stu_payment_wallet','stu_payment_wallet')->name('stu_payment_wallet');
        Route::get('/payment_request_hestory','payment_request_hestory')->name('payment_request_hestory');
        Route::match(array('GET','post'),'checkOut_payment_method/{id}/{type}/{package_id}','checkOut_payment_method')->name('checkOut_payment_method');
        Route::match(array('GET','post'),'check_promo_chapter/{type}/{id}/{price}/{promo}/{course_id}','check_promo_chapter')->name('checkOut_payment_method');
        Route::post('request_payment_method','request_payment_method')->name('request_payment_method');
        Route::post('/request_payment_chapter','request_payment_chapter')->name('request_payment_chapter');
        Route::post('/delete_account','delete_account')->name('delete_account');
        Route::match(['get', 'post'],'/session_live','session_request')->name('session_live_request');
        Route::match(['get', 'post'],'/session_private_live','session_private_request')->name('session_live_request');
        Route::post('/booking_private_session','booking_private_session')->name('booking_private_session');
        Route::get('/myLive_session','myLive_session')->name('myLive_session');
        Route::get('/stu_dia_exam_mistakes/{id}','api_dia_exam_mistakes')->name('api_dia_exam_mistakes');
        Route::get('/lesson_score_sheet_api/{id}','lesson_score_sheet_api')->name('lesson_score_sheet_api');
        Route::get('/stu_q_code','api_q_code')->name('api_q_code');

        
    });
    Route::prefix('payment')->group(function () {
    Route::any('/credit',[PaymentPaymobController::class, 'credit']);
    Route::get('/callback',[PaymentPaymobController::class, 'callback'])->withoutMiddleware(['IsUser','auth:sanctum']);
    });
});
Route::get('MobileStudent/customer_category','ApiController@customer_category')->name('customer_category');
