<?php

use App\Http\Controllers\Admin\scoreSheet\ScoreSheetExamController;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChaptersController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\DiagnosticExamController;
use App\Http\Controllers\Admin\CourseSettingController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\QuizzeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\LiveController;
use App\Http\Controllers\Admin\Ad_Slider;
use App\Http\Controllers\Admin\PaymentRequestController;
use App\Http\Controllers\Admin\ReportIssuesController;
use App\Http\Controllers\Admin\Ad_ReportsController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\LogoutUsersController;
use App\Http\Controllers\Admin\PackagesController as Ad_PackagesController;
use App\Http\Controllers\Admin\CurrencyController;

use App\Http\Controllers\Admin\paymob\CallBackPaymobController;
use App\Http\Controllers\Student\Stu_DashboardController;
use App\Http\Controllers\Student\Stu_ProfileController;
use App\Http\Controllers\Student\Stu_MyCourseController;
use App\Http\Controllers\Student\Stu_PackageController;
use App\Http\Controllers\Student\Stu_ExamController;
use App\Http\Controllers\Student\Stu_PaymentController;
use App\Http\Controllers\Student\Stu_WalletController;
use App\Http\Controllers\Student\Stu_MyPackagesController;
use App\Http\Controllers\Student\Stu_QuestionController;
use App\Http\Controllers\Student\Stu_LiveController;
use App\Http\Controllers\Student\ScoreController;

use App\Http\Controllers\Visitor\HomeController;
use App\Http\Controllers\Visitor\ContactController;
use App\Http\Controllers\Visitor\AboutController;
use App\Http\Controllers\Visitor\V_ExamController;
use App\Http\Controllers\Visitor\V_QuestionController;
use App\Http\Controllers\Visitor\V_LiveController;
use App\Http\Controllers\Visitor\V_DiaExamController;
use App\Http\Controllers\Visitor\CoursesController as V_CoursesController;

use App\Http\Controllers\Teacher\TDashboardController;
use App\Http\Controllers\Teacher\TProfileController;
use App\Http\Controllers\Teacher\TLiveController;

use App\Http\Controllers\Affilate\Aff_DashboardController;
use App\Http\Controllers\Affilate\Aff_PayoutController;
use App\Http\Controllers\Affilate\Aff_ServiceController;
use App\Http\Controllers\Affilate\Aff_ProfileController;

use App\Http\Controllers\login\LoginController;

use App\Http\Controllers\DomPdfController;

use Illuminate\Support\Facades\Route;

use App\Models\Wallet;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    $controller_path = 'App\Http\Controllers' ;

    Route::get('Affilate/Data/{id}', [Aff_DashboardController::class, 'aff_link'])->name('aff_link');
    Route::controller(LoginController::class)->group(function(){
        Route::post('/Market','market_login')->name('market_ch');
        Route::get('/login','index')->name('login.index');
        Route::post('/login.store','store')->name('login.store');
        Route::get('/sign_up','sign_up')->name('sign_up');

        Route::get('/SignupConfirm','signup_confirm')->name('signup_confirm');
        Route::get('/ProfileConfirm','profile_confirm')->name('profile_confirm');

        Route::post('/sign_up/Add','sign_up_add')->name('sign_up_add');
        Route::get('/logout','destroy')->name('logout');
        Route::get('/delete_account/{id}','delete_account')->name('delete_account');

    });

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(V_LiveController::class)->group(function(){
        Route::get('/Live_Package', 'live_package')->name('live_package');
    });

    Route::controller(V_DiaExamController::class)->group(function(){
        Route::get('/DiaExam', 'index')->name('v_dia_cate');
        Route::post('/DiaExam/Answer/{id}', 'dia_exam_ans')->name('dia_exam_ans');
        Route::get('/DiaExam/Course/{id}', 'v_dia_courses')->name('v_dia_courses');
        Route::post('/DiaExam/Exam', 'v_dia_exam')->name('v_dia_exam');
        Route::get('/DiaExam/History', 'dia_exam_history')->name('dia_exam_history');
    });
    Route::controller(V_QuestionController::class)->group(function(){
        Route::get('/Question', 'v_question')->name('v_question');
        Route::get('/Question/Filter', 'v_filter_question')->name('v_filter_question');
        Route::get('/Question/{id}', 'q_page')->name('q_page');
        Route::get('/Question_Package', 'q_package')->name('q_package');
        Route::post('/Question/Solve', 'q_sol')->name('q_sol');
        Route::post('/Question/SolveParallel', 'q_parallel_sol')->name('q_parallel_sol');
        Route::get('/Question/ParallelAnswer/{id}', 'parallel_answer')->name('parallel_answer');
        Route::get('/Question/SolveParallel/{id}', 'solve_parallel_question')->name('solve_parallel_question');
    });
    Route::controller(V_ExamController::class)->group(function(){
        Route::get('/Exams', 'v_exams')->name('v_exams');
        Route::post('/Exam/Answer/{id}','exam_ans')->name('exam_ans');
        Route::get('/Exams/Filter', 'filter_exam')->name('filter_exam');
        Route::get('/Exam/{id}', 'exam_page')->name('exam_page');
        Route::get('/Exam_package', 'e_package')->name('e_package');
        Route::get('/filterPackage', 'filter_package')->name('filter_package');
    });
    Route::controller(V_CoursesController::class)->group(function(){
        Route::post('/Use_Promocode', 'use_promocode')->name('use_promocode');
        Route::get('/CheckOut/Course', 'check_out_course')->name('check_out_course');
        Route::get('/CheckOut/Promo/Course', 'promo_check_out_course')->name('promo_check_out_course');
        Route::post('/CheckOut/Course/PromoCode', 'course_use_promocode')->name('course_use_promocode');
        Route::get('/CheckOut', 'check_out')->name('check_out');
        Route::get('/CheckOut/Chapter/Promo', 'promo_check_out_chapter')->name('promo_check_out_chapter');
        Route::post('/Course_Payment_Money', 'course_payment_money')->name('course_payment_money');
        Route::post('/Payment_Money', 'payment_money')->name('payment_money');
        Route::get('/BuyCourse', 'new_payment')->name('new_payment');
        Route::get('/BuyCourse/Promo', 'c_new_payment')->name('c_new_payment');
        Route::get('/Courses', 'categories')->name('categories');
        Route::post('/Buy_Course', 'buy_course')->name('buy_course');
        Route::get('/Buy_Course', 'cart_buy_course')->name('cart_buy_course');
        Route::get('/Course_Payment', 'course_payment')->name('course_payment');
        Route::get('/Courses/{id}', 'courses')->name('v_courses');
        Route::get('/Course/{id}', 'course')->name('v_course');
        Route::get('/Course/Remove/{id}', 'remove_course_package')->name('remove_course_package');
    });

    Route::get('/About', [AboutController::class, 'index'])->name('about');
    Route::get('/Contact', [ContactController::class, 'index'])->name('contact_us');
    Route::post('/Contact/Msg', [ContactController::class, 'contact_msg'])->name('contact_msg');

//  Hello MR Ahmed
Route::middleware(['auth','auth.Admin'])->prefix('Admin')->group(function(){

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(Ad_Slider::class)->middleware('can:Slider')->prefix('Slider')->group(function(){
        Route::get('/', 'index')->name('slider_imgs');
        Route::post('/Update', 'update_slider')->name('update_slider');
        Route::post('/Add', 'add_img_slider')->name('add_img_slider');
    });

    // Report Issues
    Route::controller(ReportIssuesController::class)->middleware('can:ReportIssues')
    ->prefix('ReportIssues')->group(function(){
        Route::get('/Question/List', 'admin_question_list_report')->name('admin_question_list_report');
        Route::post('/Question/List/Add', 'Ad_report_list_add')->name('Ad_report_list_add');
        Route::post('/Question/List/Edit/{id}', 'Ad_report_list_edit')->name('Ad_report_list_edit');
        Route::get('/Question/List/Del/{id}', 'Ad_report_list_del')->name('Ad_report_list_del');

        Route::get('/Question/Action', 'admin_question_action_report')->name('admin_question_action_report');
        Route::post('/Question/Action/Edit/{id}', 'Ad_report_question_edit')->name('Ad_report_question_edit');
        Route::get('/Question/Action/Del/{id}', 'Ad_report_question_del')->name('Ad_report_question_del');

        Route::get('/Video/List', 'admin_video_report_list')->name('admin_video_report_list');
        Route::post('/Video/List/Add', 'Ad_report_video_list_add')->name('Ad_report_video_list_add');
        Route::post('/Video/List/Edit/{id}', 'Ad_report_video_list_edit')->name('Ad_report_video_list_edit');
        Route::get('/Video/List/Del/{id}', 'Ad_report_video_list_del')->name('Ad_report_video_list_del');

        Route::get('/Video/Action', 'admin_video_action_report')->name('admin_video_action_report');
        Route::post('/Video/Action/Edit/{id}', 'Ad_report_video_edit')->name('Ad_report_video_edit');
        Route::get('/Video/Action/Del/{id}', 'Ad_report_video_del')->name('Ad_report_video_del');
    });

    // Quizze
    Route::controller(QuizzeController::class)->middleware('can:Courses')
    ->prefix('Quizze')->group(function(){
        Route::get('/', 'quizze')->name('quizze');
        Route::get('/Del/{id}', 'del_quizze')->name('del_quizze');
        Route::post('/Add', 'add_quizze')->name('add_quizze');
        Route::post('/Edit', 'edit_quizze')->name('edit_quizze');
        Route::get('/Filter', 'filter_quiz')->name('filter_quiz');
    });

    // Payment
    Route::controller(PaymentController::class)->middleware('can:Payment')->prefix('Payment')->group(function(){
        Route::get('/', 'payment')->name('payment');
        Route::post('/Add', 'payment_add')->name('payment_add');
        Route::post('/Edit', 'payment_edit')->name('payment_edit');
        Route::get('/Del', 'del_payment')->name('del_payment');
    });

    // Payment Request
    Route::controller(PaymentRequestController::class)->middleware('can:Payment')->group(function(){
        Route::get('/PenddingPayment','pendding_payment')->name('pendding_payment');
        Route::get('/Payment/Invoice/{id}','payment_material')->name('payment_material');
        Route::get('/PenddingPayment/Filter','filter_pendding_payment')->name('filter_pendding_payment');
        Route::get('/PaymentRequest','payment_request')->name('payment_request');
        Route::get('/PaymentRequest/Filter','filter_payment_req')->name('filter_payment_req');
        Route::get('/ApprovePayment/{id}','approve_payment')->name('approve_payment');
        Route::post('/RejectedPayment/{id}','rejected_payment')->name('rejected_payment');
        Route::get('/WalletPayment','wallet_pendding')->name('wallet_pendding');
        Route::get('/WalletPayment/Filter','filter_pendding_wallet')->name('filter_pendding_wallet');
        Route::get('/WalletPayment/Approve/{id}','approve_wallet')->name('approve_wallet');
        Route::post('/WalletPayment/Rejected/{id}','rejected_wallet')->name('rejected_wallet');
        Route::get('/WalletPayment/History','wallet_history')->name('wallet_history');
        Route::get('/WalletPayment/HistoryFilter','filter_wallet_history')->name('filter_wallet_history');
    });

    // Marketing
    Route::controller(MarketingController::class)->middleware('can:isMarketing')->prefix('Marketing')->group(function(){
        Route::get('/PromoCode', 'promo_code')->name('promo_code');
        Route::post('/PromoCode/Add', 'add_promo')->name('add_promo');
        Route::post('/PromoCode/Edit/{id}', 'edit_promo')->name('edit_promo');
        Route::get('/PromoCode/Del/{id}', 'del_promo')->name('del_promo');
        Route::get('/Popup', 'marketing_popup')->name('marketing_popup');
        Route::post('/Popup/Add', 'add_popup')->name('add_popup');
        Route::get('/Popup/Del/{id}', 'del_popup')->name('del_popup');
        Route::post('/Popup/Edit/{id}', 'edit_popup')->name('edit_popup');
    });

    Route::controller(MarketingController::class)
    ->middleware('can:Affilate')->prefix('Marketing')->group(function(){
        Route::get('/Commission', 'commission')->name('commission');
        Route::post('/Commission/Edit', 'edit_commission')->name('edit_commission');
        Route::get('/Users/Del/{id}', 'del_aff')->name('del_aff');
        Route::post('/Users/Edit/{id}', 'aff_edit')->name('aff_edit');
        Route::get('/Users', 'users')->name('m_users');
        Route::get('/Add_Users', 'm_add_users')->name('m_add_users');
        Route::post('/Users/Add', 'affilate_add')->name('affilate_add');
        Route::get('/Payouts', 'payout_r')->name('payout_r');
        Route::post('/Payouts_Reject/{id}', 'reject_payout')->name('reject_payout');
        Route::get('/Accept_Payouts/{id}', 'accept_payout')->name('accept_payout');
        Route::get('/Filter_Payouts', 'filter_payment')->name('filter_payment');
    });

    // Live
    Route::controller(LiveController::class)->middleware('can:Live')->prefix('Live')->group(function(){
        Route::get('/', 'index')->name('sessions');
        Route::post('/Edit/{id}', 'session_edit')->name('session_edit');
        Route::post('/Add', 'add_session')->name('add_session');
        Route::get('/Del/{id}', 'del_session')->name('del_session');
        Route::get('/Groups', 'session_g')->name('session_g');
        Route::get('/Session_G/Del/{id}', 'del_session_g')->name('del_session_g');
        Route::post('/Session_G', 'g_session_edit')->name('g_session_edit');
        Route::post('/Session_G/Add', 'g_session_add')->name('g_session_add');
        Route::get('/Private_Request', 'private_request')->name('private_request');
        Route::get('/Private_Request/Approve/{id}', 'private_session_approve')->name('private_session_approve');
        Route::post('/Private_Request/Rejected', 'private_request_rejected')->name('private_request_rejected');
        Route::get('/Cancelation', 'cancelation')->name('cancelation');
        Route::get('/Cancelation/Filter', 'filter_cancelation')->name('filter_cancelation');
        Route::get('/Cancelation/Approve/{id}', 'approve_cancelation')->name('approve_cancelation');
        Route::get('/Cancelation/Rejected/{id}', 'reject_cancelation')->name('reject_cancelation');
        Route::get('/Live/Calender', 'live_calender')->name('live_calender');
        Route::get('/Live/TeacherSession', 'teacher_session')->name('teacher_session');
        Route::get('Live/TeacherSession/Filter', 'filter_teacher_session')->name('filter_teacher_session');
        Route::get('/Live/PrivateRequestShow', 'ad_private_requests')->name('ad_private_requests');
        Route::get('/Academic', 'ad_academic')->name('ad_academic');
        Route::get('/Academic/Filter', 'ad_filter_academic')->name('ad_filter_academic');
    });

    Route::controller(AdminsController::class)->middleware('can:Admin')->prefix('Admins')->group(function(){

        Route::post('/Admin/Edit', 'admin_edit')->name('admin_edit');
        Route::get('/Admin/Del/{id}', 'del_admin')->name('del_admin');
        Route::get('/Admin_Add', 'admin_add')->name('admin_add');
        Route::post('/Admin/Add', 'add_admin')->name('add_admin');

        Route::get('/RoleAdmin', 'role_admins')->name('role_admins_list');
        Route::post('/RoleAdmin/Add', 'role_admin_add')->name('role_admin_add');
        Route::post('/RoleAdmin/Edit/{id}', 'role_admin_edit')->name('role_admin_edit');
        Route::get('/RoleAdmin/Del/{id}', 'role_del_admin')->name('role_del_admin');
        Route::get('/Admin', 'admins')->name('admins_list');
        Route::post('/Admin/Filter', 'admin_filter')->name('admin_filter');
        Route::get('/Admin/Filter', 'admin_filter')->name('admin_filter');
        // Admin
        Route::post('/Admin/Edit', 'admin_edit')->name('admin_edit');
        Route::get('/Admin/Del/{id}', 'del_admin')->name('del_admin');
        Route::get('/Admin_Add', 'admin_add')->name('admin_add');
        Route::post('/Admin/Add', 'add_admin')->name('add_admin');
    });

    Route::controller(UserController::class)->middleware('can:Users')->prefix('Users')->group(function(){

        // Teacher
        Route::post('/Teacher_Filter', 'teacher_filter')->name('teacher_filter');
        Route::get('/Teacher_Filter', 'teacher_filter')->name('teacher_filter');
        Route::get('/Teacher', 'teacher')->name('teacher');
        Route::post('/Teacher_Edit', 'teacher_edit')->name('teacher_edit');
        Route::post('/Teacher/Add', 'add_teacher')->name('add_teacher');
        Route::get('/Teacher_Add', 'teacher_add')->name('teacher_add');
        Route::get('/Teacher/Del/{id}', 'del_teacher')->name('del_teacher');

        // Students
        Route::post('/Add_Wallet', 'ad_add_wallet')->name('ad_add_wallet');
        Route::get('/Student', 'student')->name('student');
        Route::post('/Student_Filter', 'student_filter')->name('student_filter');
        Route::get('/Student/Info', 'stu_info')->name('stu_info');
        Route::get('/Student/Details/{id}', 'stu_details')->name('stu_details');
        Route::get('/Student/Parent/{id}', 'stu_parent_details')->name('stu_parent_details');
        Route::get('/Student/Academic/{id}', 'stu_academic')->name('stu_academic');
        Route::post('/Student/LiveAttend/{user_id}/{lesson_id}', 'live_attend')->name('live_attend');
        Route::get('/Student/LiveWaiting/{user_id}/{lesson_id}', 'live_waiting')->name('live_waiting');
        Route::get('/Student/LiveContent/{id}', 'stu_live_content')->name('stu_live_content');
        Route::post('/Student/LiveContent/extraDay/{lesson}', 'extraDays')->name('extraDay');
        Route::get('/Student/LiveContent/{id}/{course_id}', 'stu_live_course_content')->name('stu_live_course_content');
        Route::get('/Add_Student', 'add_student')->name('add_student');
        Route::get('/Student/Del/{id}', 'del_stu')->name('del_stu');
        Route::get('/Student/Delete/{id}', 'del_student')->name('del_student');
        Route::post('/Student/Add', 'student_add')->name('student_add');
        Route::post('/Student/Edit', 'stu_edit')->name('stu_edit');
        Route::get('/Student/Payments/{id}', 'student_payments')->name('student_payments');
    });

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [ DashboardController::class, 'index'])->name('dashboard');


    // Courses
    Route::controller(CoursesController::class)->middleware('can:Courses')->group(function(){
        Route::get('/Courses','courses')->name('courses');
        Route::post('/Courses_Filter','course_filter')->name('course_filter');
        Route::get('/Courses_Filter','course_filter')->name('course_filter');
        Route::post('/Courses/Edit','course_edit')->name('course_edit');
        Route::get('/Courses/Del/{id}','del_course')->name('del_course');
        Route::get('/Courses/Add_Courses','add_courses')->name('add_courses');
        Route::post('/Courses/Courses/Add','course_add')->name('course_add');
    });

    // Chapters
    Route::controller(ChaptersController::class)->middleware('can:Courses')->group(function(){
        Route::get('/Chapter','chapter')->name('chapter');
        Route::post('/Chapter_Filter','ch_filter')->name('ch_filter');
        Route::get('/Chapter_Filter','ch_filter')->name('ch_filter');
        Route::post('/Chapter/Edit','chapter_edit')->name('chapter_edit');
        Route::post('/Chapter/Add','add_chapter')->name('add_chapter');
        Route::get('/Chapter/Del/{id}','del_chapter')->name('del_chapter');
    });

    // Questions
    Route::controller(QuestionController::class)->middleware('can:Courses')->group(function(){
        Route::get('/Question','question')->name('question');
        Route::post('/Question/Edit/{id}','q_edit')->name('q_edit');
        Route::post('/Question/Add','add_q')->name('add_q');
        Route::post('/Question/Filter','filter_question')->name('filter_question');
        Route::get('/Question/Filter','filter_question')->name('filter_question');
        Route::get('/Question/Del/{id}','del_q')->name('del_q');
    });

    //Course Setting
    Route::controller(CourseSettingController::class)->middleware('can:Settings')->group(function(){
        Route::get('/Courses/CodeExam','course_setting')->name('course_setting');
        Route::post('/Courses/CodeExam/Add','code_exam_add')->name('code_exam_add');
        Route::post('/Courses/CodeExam/Edit/{id}','examCodeEdit')->name('examCodeEdit');
        Route::get('/Courses/CodeExam/Del/{id}','examCodeDelete')->name('examCodeDelete');
    });

    // Logout Users
    Route::controller(LogoutUsersController::class)->middleware('can:Settings')->group(function(){
        Route::get('/LogoutUsers','index')->name('logout_users');
        Route::get('/LogoutUsers/{id}','logout')->name('logout_account_users');
    });

    Route::controller(CurrencyController::class)->middleware('can:Settings')->prefix('Currency')->group(function(){
        Route::get('/', 'view')->name('currency');
        Route::post('/Add', 'add')->name('add_currency');
        Route::post('/Edit/{id}', 'modify')->name('edit_currency');
        Route::get('/delete/{id}', 'delete')->name('delete_currency');
    });

    // Diagnostic Exam
    Route::controller(DiagnosticExamController::class)->middleware('can:Courses')->group(function(){
        Route::get('/Diagnostic_Exam','index')->name('dia_exam');
        Route::post('/Diagnostic_Exam/Add','add_diaexam')->name('add_diaexam');
        Route::get('/Diagnostic_Exam/edit_q_dia_exam','edit_q_dia_exam')->name('edit_q_dia_exam');
        Route::get('/Diagnostic_Exam/Del/{id}','del_dia_exam')->name('del_dia_exam');
        Route::post('/Diagnostic_Exam/Edit/{id}','edit_dia_exam_item')->name('edit_dia_exam_item');
    });

    // Exam
    Route::controller(ExamController::class)->middleware('can:Courses')->group(function(){
        Route::get('/Exam/Del/{id}','del_exam')->name('del_exam');
        Route::post('/Exam/Edit','edit_exam')->name('edit_exam');
        Route::get('/Exam/edit_q_exam','edit_q_exam')->name('edit_q_exam');
        Route::get('/Exam','index')->name('exam');
        Route::post('/Exam/Add','add_exam')->name('add_exam');
    });

    Route::controller(ExamController::class)->middleware('can:Settings')->group(function(){
        Route::get('/ScoreSheet','score_sheet')->name('exam_score_sheet');
        Route::post('/ScoreSheet/Add','addScore')->name('addScore');
        Route::post('/ScoreSheet/Edit/{id}','editScore')->name('editScore');
        Route::get('/ScoreSheet/Del/{id}','scoreDelete')->name('scoreDelete');
    });

    // Category
    Route::controller(CategoryController::class)->middleware('can:Courses')->group(function(){
        Route::get('/category/Information','index')->name('category');
        Route::post('/category/categoryAdd','createCategory')->name('addCategories');
        Route::get('/category/categoryDelete/{id}','categoryDelete')->name('categoryDelete');
        Route::post('/category/categoryEdit','editCategory')->name('categoryEdit');
    });

    // Lesson
    Route::controller(LessonController::class)->middleware('can:Courses')->group(function(){
        Route::get('Lesson/Lessons','index')->name('lesson');
        Route::post('Lesson/AddLesson','addLesson')->name('addLesson');
        Route::post('Lesson/Edit','lesson_edit')->name('lesson_edit');
        Route::get('Lesson/Del/{id}','del_lesson')->name('del_lesson');
        Route::post('Lesson/Filter','filter_lesson')->name('filter_lesson');
        Route::get('Lesson/Filter','filter_lesson')->name('filter_lesson');
    });

    // Packages
    Route::controller(Ad_PackagesController::class)->middleware('can:Packages')->group(function(){
        Route::get('Packages','index')->name('admin_packages');
        Route::get('Packages/Stu_Add','add_stu_package')->name('add_stu_package');
        Route::get('Packages/Del/{id}','del_package')->name('del_package');
        Route::post('Packages/Edit/{id}','edit_package')->name('edit_package');
        Route::post('Packages/Add','add_package')->name('add_package');
        Route::post('SmallPackages/Add','add_small_package')->name('add_small_package');

        Route::get('Packages/History','package_history')->name('package_history');
        Route::get('Packages/History/Filter','package_history_admin')->name('package_history');
    });

    // Reports
    Route::middleware('can:Reports')->group(function(){
        // Teacher Report

        Route::controller(Ad_ReportsController::class)->group(function(){
            Route::get('/Report/Live','ad_live_report')->name('ad_live_report');
            Route::get('/Report/Grade','ad_grade_report')->name('ad_grade_report');
            Route::get('/Report/Payment','ad_payment_report')->name('ad_payment_report');
            Route::get('/Report/Course','ad_course_report')->name('ad_course_report');
            Route::get('/Report/Question','ad_exam_report')->name('ad_question_report');
            Route::get('/Report/ScoreSheet','ad_score_sheet_report')->name('ad_score_sheet_report');
        
            Route::get('/Report/ScoreSheet/Show/{id}','score_sheet_student')->name('score_sheet_student');
            Route::get('/Report/Question/Filter','ad_report_filter_exam')->name('ad_report_filter_question');

            Route::get('/Report/ScoreSheet/Show/Mistakes/{id}','ad_score_sheet_mistake')->name('ad_score_sheet_mistake');
            Route::get('/Report/ScoreSheet/Exam/Mistakes/{id}','ad_score_exam_mistake')->name('ad_score_exam_mistake');
            Route::get('/Report/ScoreSheet/Answer/{id}','ad_score_question_answer')->name('ad_score_question_answer');
            Route::get('/Report/ScoreSheet/Parallel/{id}','ad_question_parallel')->name('ad_question_parallel');
            Route::post('/Report/ScoreSheet/Solve/{id}','ad_solve_parallel')->name('ad_solve_parallel');
        });
         Route::controller(ScoreSheetExamController::class)->group(function () {
        Route::get('Report/ScoreSheet/student/{user}', 'index')->name('scor_sheet_exam'); // Fetch course score data
        Route::get('Report/ScoreSheet/get/courseExam/{user}', 'show')->name('course_exam'); // Get course score data
    });
    });

    Route::controller(DomPdfController::class)->middleware('can:Reports')->group(function(){
        Route::post('/Report/Question/pdf','exam_pdf')->name('exam_pdf');
        Route::get('/Report/ScoreSheet/Show/Quiz/Report/{id}', 'quizze_report')->name('quizze_report');
    });
            //  Start Score Sheet Exam
   
            //  End Score Sheet Exam

});


    // Student

Route::middleware(['auth','auth.student'])->prefix('student')->group(function(){
    App::singleton('wallet', function(){
        $money = Wallet::where('student_id', auth()->user()->id)
        ->where('state', 'Approve')
        ->sum('wallet');

        return $money;
    });


    Route::controller(DomPdfController::class)->group(function(){
        Route::get('/DiaExam/PDF/{id}', 'dia_exam_mistake_pdf')->name('dia_exam_mistake_pdf');
        Route::get('/Exam/PDF/{id}', 'exam_mistake_pdf')->name('exam_mistake_pdf');
    });

    // Route::controller(ScoreController::class)->group(function(){
    //     Route::get('ScoreSheet','score_sheet')->name('score_sheet');
    // });

    // Route::controller(ScoreController::class)->group(function () {
    //     Route::get('ScoreSheet', 'score_sheet')->name('score_sheet'); // Get the score sheet view
    //     Route::post('course_score_sheet', 'course_score_sheet')->name('course_score_sheet'); // Fetch course score data
    // });
    Route::controller(ScoreController::class)->group(function () {
        Route::get('ScoreSheet', 'score_sheet')->name('score_sheet'); // Get the score sheet view
        Route::post('course_score_sheet', 'course_score_sheet')->name('course_score_sheet'); // Fetch course score data

        // New routes for fetching chapters and lessons
        // Route::post('fetch_chapters', 'fetchChapters')->name('fetch_chapters'); // Fetch chapters based on course
        // Route::post('fetch_lessons', 'fetchLessons')->name('fetch_lessons'); // Fetch lessons based on chapter
    });


    Route::controller(Stu_DashboardController::class)->group(function(){
        Route::get('Student','index')->name('stu_dashboard');
    });

    Route::controller(Stu_LiveController::class)->group(function(){
        Route::get('MySessions', 'stu_mysessions')->name('stu_mysessions');
        Route::get('Live/Courses', 'stu_myLiveCourse')->name('stu_myLiveCourse');
        Route::get('Live/Chapter/{course_id}', 'stu_live_chapters')->name('stu_live_chapters');
        Route::get('Live/Lessons/{chapter_id}', 'stu_myLiveLesson')->name('stu_myLiveLesson');
        Route::post('Live/Lesson', 'stu_live_lesson')->name('stu_live_lesson');
        Route::get('Live/ShowPDF/{file_name}', 'stu_live_pdf')->name('stu_live_pdf');
        Route::get('UseLive/{id}', 'use_live')->name('use_live');
        Route::get('Live/PrivateRequest', 'stu_private_req')->name('stu_private_req');
        Route::get('Live/Student', 'v_live')->name('v_live');
    });

    Route::controller(DomPdfController::class)->group(function(){
        Route::get('/DiaReport/{id}','dia_exam_report_pdf')->name('dia_exam_report_pdf');
        Route::post('Exam/PDF', 'stu_quize_pdf')->name('stu_quize_pdf');
        Route::get('Quiz/Report/{id}', 'quizze_report')->name('quizze_report');
    });

    Route::controller(Stu_PackageController::class)->group(function(){
        Route::get('Package/Checkout/{id}', 'package_checkout')->name('package_checkout');
        Route::post('Package/Payment/{id}', 'payment_package')->name('payment_package');
        Route::post('Package/PromoCode', 'package_use_promocode')->name('package_use_promocode');
    });

    Route::controller(Stu_PaymentController::class)->group(function(){
        Route::get('PaymentHistory', 'stu_payment_history')->name('stu_payment_history');
        Route::post('PaymentInvoice/Filter', 'payment_filter')->name('payment_filter');
        Route::get('PaymentInvoice/{id}', 'payment_invoice')->name('payment_invoice');
    });

    Route::controller(Stu_QuestionController::class)->group(function(){
        Route::get('QuestionHistory', 'question_history')->name('question_history');
        Route::get('QuestionMistakes/{id}', 'question_mistakes')->name('question_mistakes');
    });

    Route::controller(Stu_MyPackagesController::class)->group(function(){
        Route::get('MyPackages', 'my_packages')->name('my_packages');
    });

    Route::controller(Stu_WalletController::class)->group(function(){
        Route::get('Wallet', 'index')->name('wallet');
        Route::get('Wallet/Filter', 'wallet_filter')->name('wallet_filter');
        Route::post('Wallet/Add', 'add_wallet')->name('add_wallet');
    });


    Route::controller(Stu_ProfileController::class)->group(function(){

        Route::get('/Profile','index')->name('stu_profile');
        Route::post('/Profile/Edit','stu_edit_profile')->name('stu_edit_profile');
    });

    Route::controller(Stu_ExamController::class)->group(function(){
        Route::get('/Exam/History','exam_history')->name('exam_history');
        Route::get('/Exam/Mistakes/{id}','exam_mistakes')->name('exam_mistakes');
    });


    Route::controller(Stu_MyCourseController::class)->prefix('MyCourses')->group(function(){
        Route::get('/','index')->name('stu_my_courses');
        Route::get('/Courses','courses')->name('stu_courses');
        Route::get('/Chapters/{id}','stu_chapters')->name('stu_chapters');
        Route::get('/Lesson/{id}/{L_id}/{idea}','stu_lessons')->name('stu_lessons');
        Route::post('/Quizze/Answer','quizze_ans')->name('quizze_ans');
        Route::get('/Quizze/Parallel/{id}','question_parallel')->name('question_parallel');
        Route::post('/Quizze/Solve_Parallel/{id}','solve_parallel')->name('solve_parallel');
        Route::get('/Quizze/{id}','stu_quizze')->name('stu_quizze');
        Route::get('/HistoryQuizze','quizze_history')->name('quizze_history');
        Route::get('/Mistakes/{id}','quizze_mistakes')->name('quizze_mistakes');
        Route::get('/Quizze/Question/{id}','quizze_ques_ans')->name('quizze_ques_ans');
        Route::get('/Buy_Chapter/{id}','buy_chapter')->name('buy_chapter');
        Route::post('/Buy_Chapters','dia_buy_chapters')->name('dia_buy_chapters');
    });

});

// Affilate

Route::middleware(['auth','auth.affilate'])->prefix('Affilate')->group(function(){
    Route::controller(Aff_DashboardController::class)->group(function(){
        Route::get('/', 'index')->name('stu_affilate');
    });

    Route::controller(Aff_PayoutController::class)->group(function(){
        Route::get('/Payout', 'index')->name('aff_payout');
        Route::post('/Payout/Add', 'aff_add_payout_req')->name('aff_add_payout_req');
    });

    Route::controller(Aff_ServiceController::class)->group(function(){
        Route::get('/Services', 'aff_service')->name('aff_service');
    });

    Route::controller(Aff_ProfileController::class)->group(function(){
        Route::get('/Profile', 'aff_profile')->name('aff_profile');
        Route::post('/Profile/Edit', 'aff_edit_profile')->name('aff_edit_profile');
    });

});

// Teacher

Route::middleware(['auth','auth.teacher'])->prefix('Teacher')->group(function(){
    Route::get('/',  [TDashboardController::class, 'index'])->name('t_dashboard');

    Route::controller(TProfileController::class)->prefix('Profile')->group(function(){
        Route::get('/', 'index')->name('t_profile');
        Route::post('/Edit', 't_edit_profile')->name('t_edit_profile');
    });

    Route::controller(TLiveController::class)->prefix('Live')->group(function(){
        Route::get('/', 'index')->name('t_live');
    });
});

Route::get('/logout',  [LoginController::class, 'destroy'])->name('logout');
Route::get('/callback', [CallBackPaymobController::class, 'callback'])->name('callback');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

});


Route::fallback(function () {
    return view('errors.404');
});
