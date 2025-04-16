<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use ErrorException;
use App\Models\City;
use App\Models\Exam;
use App\Models\User;
use App\Mail\MyEmail;

use App\Models\Q_ans;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\quizze;
use App\Models\Wallet;
use App\Models\Chapter;
use App\Models\Country;
use App\Models\Mcq_ans;
use App\Models\Package;
use App\Models\Session;
use App\Models\Category;
use App\Models\Question;
use App\Models\ExamCodes;
use App\Models\Marketing;
use App\Models\PromoCode;
use App\Models\ScoreList;
use App\Mail\Sign_upEmail;
use App\Models\UsagePromo;
use App\Models\ConfirmSign;
use App\Models\ExamHistory;
use App\Models\ExamMistake;
use App\Models\PromoCourse;
use App\Models\PaymentOrder;
use App\Models\PromoPackage;
use App\Models\SmallPackage;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\StudentQuizze;
use App\Models\DaiExamMistake;
use App\Models\DiagnosticExam;
use App\Models\ForgetPassword;
use App\Models\PaymentRequest;
use App\Models\SessionStudent;
use App\Models\QuestionHistory;
use App\Models\LoginUser;

use App\Models\SessionAttendance;
use App\Models\PaymentPackageOrder;
use App\Http\Controllers\Controller;
use App\Models\StudentQuizzeMistake;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;
use App\Models\DiagnosticExamsHistory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PaymentHandlRequest;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Mail\ForgetPassword as ForgetPasswordEmail;
use App\Http\Requests\paymentRequest as RequestsPaymentRequest;

class ApiController extends Controller
{

    protected $request_wallet_student = [
        'student_id',
        'rejected_reason',
        'wallet',
        'date',
        'image',
        'payment_method_id',
        'state',
        'payment_request_id',
    ];
    protected $reqeust_payment_method = [
        'payment_method_id',
        'payment',
        'price',
        'image',
        'type',
        'state',
    ];
    protected $request_package_order = [
        'payment_request_id',
        'package_id',
        'discount',
        'state',
        'date',
        'number',
        'user_id',
    ];
    protected $request_chapters_order = [
        'payment_request_id',
        'id',
        'state',
        'duration',
    ];
    protected $paymentRequestChapter = [
        'payment_method_id',
        'user_id',
        'price',
        'duration',
        'type',
        'image',
        'state',
    ];

    protected $live_session_request = [
        'category_id',
        'course_id',
        'start_date',
        'end_date',
    ];
    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $req->email)->first();
            if ($user->state == 'hidden') {
                return response()->json([
                    'faild' => ' This Account Unavailable'
                ]);
            }
            LoginUser::create([
            'type' => 'mobile', 
            'user_id'=> $user->id]);
            $token = $user->createToken("personal access tokens")->plainTextToken;
            $user->token = $token;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json(['faild' => 'Your Account Not Available']);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        LoginUser::where('type', 'mobile')
        ->where('user_id', $user->id)
        ->delete();
        $user = Auth::user();
        $request->user();
        if (empty($user)) {
            return response()->json(['faild' => 'You are not Login'], 403);
        }
        if ($user->tokens()->delete()) {
            return response()->json(['success' => 'Logout Success'], 200);
        }
    }

    public function api_stu_my_courses(Request $req)
    {

        $payment_request = PaymentRequest::where('user_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->get();
        $courses_name = [];
        $iter = 0;
        foreach ($payment_request as $item) {
            foreach ($item->order as $value) {
                $courses_name[$value->course->course_name] = $value->course;
            }
        }
        $courses = [];
        foreach ($courses_name as $key => $item) {
            $courses[] = $item;
        }
        // for ($i=0, $end = count($courses); $i < $end; $i++) { 
        //     $courses[$i]['storage'] = 'https://login.mathshouse.net/'. 
        //     public_path() . '/images/courses/' . $courses[$i]['course']['course_url'];
        // }
        foreach ($courses as $images) {
            $images['course_url'] = url("images/courses/" . $images['course_url']);
        }
        return response()->json([
            'courses' => $courses,
        ], 200);
    }

    public function api_stu_my_chapter(Request $req)
    {
        // New Code
        $payment_request = PaymentRequest::where('user_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->get();
        $chapters_name = [];
        $iter = 0;
        foreach ($payment_request as $item) {
            foreach ($item->order as $value) {
                $chapters_name[$value->id] = $value;
            }
        }
        $chapters = [];
        foreach ($chapters_name as $key => $item) {
            $chapters[] = $item;
        }
        // for ($i=0, $end = count($courses); $i < $end; $i++) { 
        //     $courses[$i]['storage'] = 'https://login.mathshouse.net/'. 
        //     public_path() . '/images/courses/' . $courses[$i]['course']['course_url'];
        // }
        foreach ($chapters as $images) {
            $images['ch_url'] = url("images/Chapters/" . $images['ch_url']);
        }

        return response()->json([
            'chapters' => $chapters,
        ], 200);
    }

    public function api_stu_lesson(Request $req)
    {
        $lessons = Lesson::with('ideas')
            ->get();

        foreach ($lessons as $lesson) {

            $lesson->lesson_url = url('images/lesson/' . $lesson->lesson_url);
            foreach ($lesson->ideas as $idea)
                $idea->pdf = url('files/lessons_pdf/' . $idea->pdf);
        }

        return response()->json([
            'lessons' => $lessons
        ], 200);
    }

    public function api_stu_exam($id)
    {

        // $exams = Exam::where('id', $id)
        //     ->with('question')
        //     ->first();
        // $arr = [];
        // if ($exams) {
        //     if ($exams->question) {
        //     //   return $questions = $exams->question->with('g_ans')->get();
        //         foreach ($exams->question as $item) {
        //             $ans = Mcq_ans::where('q_id', $item->id)
        //                 ->get();
        //             $item->q_url = url('images/questions/' . $item->q_url );
        //             $arr['questionExam'] = [
        //                 'question' => $item ,
        //                 'Answers' => $ans
        //             ];
        //         }
        //     } else {
        //         return response()->json([
        //             'faild' => ' Question Is Empty'
        //         ], 404);
        //     }
        // } else {
        //     return response()->json([
        //         'faild' => ' Exam Is Empty'
        //     ], 404);
        // }
        // $exams = Exam::where('id', $id)
        //     ->with('question')
        //     ->first();
        // $arr = [];
        // if ($exams) {
        //     if ($exams->question) {
        //     //   return $questions = $exams->question->with('g_ans')->get();
        //         foreach ($exams->question as $item) {
        //             $ans = Mcq_ans::where('q_id', $item->id)
        //                 ->get();
        //             $item->q_url = url('images/questions/' . $item->q_url );
        //             $arr['questionExam'][] = [
        //                 'question' => $item ,
        //                 'Answers' => $ans
        //             ];
        //         }
        //     } 
        //     else {
        //         return response()->json([
        //             'faild' => ' Question Is Empty'
        //         ], 404);
        //     }
        // } else {
        //     return response()->json([
        //         'faild' => ' Exam Is Empty'
        //     ], 404);
        // }


        // return response()->json([
        //     'exam' => $arr
        // ], 200);
        // return response()->json([
        //     'exam' => $arr
        // ], 200);

        // Code With Packages
        $payments = PaymentPackageOrder::where('state', 1)
            ->with('pay_req')
            ->with('package')
            ->get();
        $user = User::where('id', auth()->user()->id)
            ->first();

        $small_package = SmallPackage::where('user_id', auth()->user()->id)
            ->where('module', 'Exam')
            ->where('number', '>', 0)
            ->first();

        if (!empty($small_package)) {
            SmallPackage::where('user_id', auth()->user()->id)
                ->where('module', 'Exam')
                ->where('number', '>', 0)
                ->update([
                    'number' => $small_package->number - 1
                ]);
            // Return Exam

            $exams = Exam::where('id', $id)
                ->with('question')
                ->first();
            $arr = [];

            if ( $exams->question ) {
                foreach ($exams->question as $item) {
                    $ans = Mcq_ans::where('q_id', $item->id)
                        ->get();
                    $item->q_url = url('images/questions/' . $item->q_url);
                    $arr['questionExam'][] = [
                        'question' => $item,
                        'Answers' => $ans
                    ];
                }
            }

            return response()->json([
                'exam' => $arr
            ], 200);
        }

        foreach ($payments as $item) {
            $newTime = Carbon::now()->subDays($item->package->number);

            if (
                $item->package->module == 'Exam' &&
                $item->pay_req->user_id == auth()->user()->id &&
                $item->date > $newTime &&
                $item->number > 0
            ) {

                PaymentPackageOrder::where('id', $item->id)
                    ->update([
                        'number' => $item->number - 1
                    ]);

                // Return Exam

                $exams = Exam::where('id', $id)
                    ->with('question')
                    ->first();
                $arr = [];

                foreach ($exams->question as $item) {
                    $ans = Mcq_ans::where('q_id', $item->id)
                        ->get();
                    $item->q_url = url('images/questions/' . $item->q_url);
                    $arr['questionExam'][] = [
                        'question' => $item,
                        'Answers' => $ans
                    ];
                }

                return response()->json([
                    'exam' => $arr
                ], 200);
            }
        }

        $package = Package::where('module', 'Exam')
            ->get();
        return response()->json([
            'exam' => [],
        ]);
    }
    // End Function Student Exam

    public function api_stu_live()
    {
        // Return Live
        $sessions = SessionStudent::where('user_id', auth()->user()->id)
            ->with('session')
            ->get();

        return response()->json([
            'sessions' => $sessions
        ], 200);
    }

    public function api_link_live(Request $req, $id)
    {
        $session_attendance = SessionAttendance::
        where('user_id', auth()->user()->id)
        ->where('session_id', $id)
        ->first();
        if ( !empty($session_attendance) ) {
            // Return Live
            return response()->json([
                'success' => 'You Attend Success'
            ], 200);
        }
        SessionAttendance::
        create([
            'user_id' => auth()->user()->id,
            'session_id' => $id
        ]);

        // Code With Packages
        $payments = PaymentPackageOrder::where('state', 1)
            ->with('pay_req')
            ->with('package')
            ->get();
        $user = User::where('id', auth()->user()->id)
            ->first();

        $small_package = SmallPackage::where('user_id', auth()->user()->id)
            ->where('module', 'Live')
            ->where('number', '>', 0)
            ->first();

        if (!empty($small_package)) {
            SmallPackage::where('user_id', auth()->user()->id)
                ->where('module', 'Live')
                ->where('number', '>', 0)
                ->update([
                    'number' => $small_package->number - 1
                ]);
            // Return Live
            return response()->json([
                'success' => 'You Attend Success'
            ], 200);
        }

        foreach ($payments as $item) {
            $newTime = Carbon::now()->subDays($item->package->number);

            if (
                $item->package->module == 'Live' &&
                $item->pay_req->user_id == auth()->user()->id &&
                $item->date > $newTime &&
                $item->number > 0
            ) {

                PaymentPackageOrder::where('id', $item->id)
                    ->update([
                        'number' => $item->number - 1
                    ]);

                // Return Live
                return response()->json([
                    'success' => 'You Attend Success'
                ], 200);
            }
        }

        return response()->json([
            'Sorry' => 'You Must Buy New Package',
        ]);
    }

    public function api_stu_exam_filter()
    {
        $courses = Course::all();
        $categories = Category::all();
        $codes = ExamCodes::all();

        return response()->json([
            'courses' => $courses,
            'categories' => $categories,
            'codes' => $codes,
        ]);
    }

    public function api_filter_exam(Request $req)
    {
        // "year":"2024","month":"1","code_id":"1","course_id":"2"
        $exams = Exam::with('question')
            ->get();
        foreach ($exams as $exam) {
            $questions = $exam->question;
            foreach ($questions as $question) {
                $question->q_url = url('images/questions/' . $question->q_url);
            }
        }
        $exam_items = $exams;
        if (!empty($req->year)) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ($item->year == $req->year) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        if (!empty($req->month)) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ($item->month == $req->month) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        if (!empty($req->code_id)) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ($item->code_id == $req->code_id) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        if (!empty($req->course_id)) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ($item->course_id == $req->course_id) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }

        $exam_code = ExamCodes::all();
        $courses = Course::all();
        $categories = Category::all();
        foreach ($courses as $course) {
            $course->course_url = url('images/courses/' . $course->course_url);
        }
        return response()->json([
            'exam_items' => $exam_items,
            'exam_code' => $exam_code,
            'courses' => $courses,
            'categories' => $categories,
        ]);
    }

    public function api_question_history()
    {
        $q_history = QuestionHistory::where('user_id', auth()->user()->id)
            ->with('question')
            ->get();

        return response()->json([
            'history' => $q_history,
        ]);
    }

    public function api_question_filter(Request $req)
    {
        // Code With Packages
        $payments = PaymentPackageOrder::where('state', 1)
            ->with('pay_req')
            ->with('package')
            ->get();
        $user = User::where('id', auth()->user()->id)
            ->first();

        $small_package = SmallPackage::where('user_id', auth()->user()->id)
            ->where('module', 'Question')
            ->where('number', '>', 0)
            ->first();

        if (!empty($small_package)) {
            SmallPackage::where('user_id', auth()->user()->id)
                ->where('module', 'Question')
                ->where('number', '>', 0)
                ->update([
                    'number' => $small_package->number - 1
                ]);
            // Return Question


            $question = Question::with('mcq')
                ->with('g_ans')
                ->with('q_ans')
                ->get();
            for ($i = 0, $end = count($question); $i < $end; $i++) {
                $question[$i]['q_url'] = url('images/questions/' . $question[$i]['q_url']);
            }


            return response()->json([
                'q_items' => $question,
            ]);
        }

        foreach ($payments as $item) {
            $newTime = Carbon::now()->subDays($item->package->number);

            if (
                $item->package->module == 'Question' &&
                $item->pay_req->user_id == auth()->user()->id &&
                $item->date > $newTime &&
                $item->number > 0
            ) {

                PaymentPackageOrder::where('id', $item->id)
                    ->update([
                        'number' => $item->number - 1
                    ]);

                // Return Question


                $question = Question::with('mcq')
                    ->with('g_ans')
                    ->with('q_ans')
                    ->get();
                for ($i = 0, $end = count($question); $i < $end; $i++) {
                    $question[$i]['q_url'] = url('images/questions/' . $question[$i]['q_url']);
                }


                return response()->json([
                    'q_items' => $question,
                ]);
            }
        }

        return response()->json([
            'Sorry' => 'You Must Buy New Package',
            'q_items' => [],
        ]);
    }

    public function api_question_mistake($id)
    {
        $question = Question::where('id', $id)
            ->first();
        //q_url
        $question_ans = Q_ans::where('Q_id', $id)
            ->get();
        $question->q_url = url('images/questions/' . $question->q_url);
        foreach ($question_ans as $question_an) {
            $question_an->ans_pdf = url('files/q_pdf/' . $question_an->ans_pdf);
        }
        $parallel = Question::where('year', $question->year)
            ->where('month', $question->month)
            ->where('section', $question->section)
            ->where('q_num', $question->q_num)
            ->where('id', '!=', $id)
            ->with('mcq')
            ->with('g_ans')
            ->get();
            foreach ($parallel as $item) {
                $item->q_url = url('images/questions/' . $item->q_url);
            }

        return response()->json([
            'question' => $question,
            'question_ans' => $question_ans,
            'parallel' => $parallel,
        ]);
    }

    public function api_dia_exam_filter()
    {
        $categories = Category::all();
        $courses = Course::all();

        return response()->json([
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }

    public function api_dia_exam($id)
    {
        $exam = DiagnosticExam::where('course_id', $id)
            ->with('question_with_ans')
            ->get();
        $num = rand(0, count($exam) - 1);
        if (!isset($exam[$num])) {
            return response()->json([
                'faild' => 'Diagnostic Exams Is Empty'
            ]);
        }
        $exam = $exam[$num];
        foreach ($exam->question_with_ans as $exam_question) {
            $exam_question->q_url = url("images/questions/" . $exam_question->q_url);
        }
        return response()->json([
            'exam' => $exam
        ]);
    }

    public function api_history()
    {
        $q_history = QuestionHistory::where('user_id', auth()->user()->id)
            ->orderByDesc('id')
            ->with('question')
            ->get();
        $exam_history = ExamHistory::where('user_id', auth()->user()->id)
            ->orderByDesc('id')
            ->with('exams')
            ->get();
        $dia_exam_history = DiagnosticExamsHistory::where('user_id', auth()->user()->id)
            ->orderByDesc('id')
            ->with('exams')
            ->get();
        $quiz_history = StudentQuizze::where('student_id', auth()->user()->id)
            ->orderByDesc('id')
            ->with('lesson_api')
            ->with('questions')
            ->with('quizze')
            ->get();

        return response()->json([
            'question' => $q_history,
            'exam' => $exam_history,
            'dia_exam' => $dia_exam_history,
            'quiz_history' => $quiz_history
        ]);
    }

    public function api_profile_data()
    {
        $user = User::where('id', auth()->user()->id)
            ->first();
        if (Auth::check()) {
            if ($user) {
                $user['image'] = url('images/users/' . $user->image);
                return response()->json([
                    'user' => $user
                ]);
            } else {
            }
        } else {
            return response()->json(['faild' => 'You UnAuthorized'], 401);
        }
    }

    public function api_profile_date_edit(Request $req)
    {
        $validate_image = $req->validate(['image' => 'image|mimes:png,jpg,jpeg,gif']);
        $image = $req->file('image');

        if (!empty($image)) {
            $filename = $image->getClientOriginalName();

            $image->move(public_path('images/users'), $filename);
            $arr['image'] = $filename;
        }
        $user = User::where('id', '!=', auth()->user()->id)
            ->where('email', $req->email)
            ->first();
        if (!empty($user)) {
            return response()->json([
                'faild' => 'Email Is Exist Please Change It'
            ]);
        }
        $arr = $req->only('f_name', 'l_name', 'email', 'phone', 'nick_name');

        $emails = [];

        if (!empty($req->password)) {
            $arr['password'] = bcrypt($req->password);
        }
        // if ( !empty($req->parent_email) ) {
        // $email = $req->parent_email;
        // $type = "parent";
        // $user_id = auth()->user()->id;
        // Mail::To($email)->send(new MyEmail($email, $type, $user_id));
        // }
        if (!empty($req->parent_phone)) {
            $arr['parent_phone'] = $req->parent_phone;
        }
        // if ( !empty($req->extra_email) ) {
        // $email = $req->extra_email;
        // $type = "extra";
        // $user_id = auth()->user()->id;
        // Mail::To($email)->send(new MyEmail($email, $type, $user_id));
        // }

        User::where('id', auth()->user()->id)
            ->update($arr);

        return response()->json([
            'success' => 'You Update Your Profile Successfuly'
        ]);
    }


    public function api_profile_edit(Request $req)
    {
        $img_name = null;
        extract($_FILES['image']);
        $user = User::where('id', '!=', auth()->user()->id)
            ->where('email', $req->email)
            ->first();
        if (!empty($user)) {
            return response()->json(['faild' => 'Email Is Exist Please Change It']);
        }
        $arr = $req->only('name', 'email', 'phone', 'nick_name');
        if (!empty($name)) {
            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if (in_array($extension, $extension_arr)) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['image'] = $img_name;
            }
        }
        $emails = [];

        if (!empty($req->password)) {
            $arr['password'] = bcrypt($req->password);
        }
        if (!empty($req->parent_email)) {
            $email = $req->parent_email;
            $type = "parent";
            $user_id = auth()->user()->id;
            Mail::To($email)->send(new MyEmail($email, $type, $user_id));
        }
        if (!empty($req->parent_phone)) {
            $arr['parent_phone'] = $req->parent_phone;
        }
        if (!empty($req->extra_email)) {
            $email = $req->extra_email;
            $type = "extra";
            $user_id = auth()->user()->id;
            Mail::To($email)->send(new MyEmail($email, $type, $user_id));
        }
        move_uploaded_file($tmp_name, 'images/users/' . $img_name);
        User::where('id', auth()->user()->id)
            ->update($arr);
        return response()->json([
            'success' => 'Your data change success',
            'user' => auth()->user()
        ]);
    }

    public function api_exam_grade(Request $req)
    {
        $user_id = $req->user()->id;
        $chapters = [];
        $mistakes = count(json_decode($req->mistakes)) == 0 ? [] : json_decode($req->mistakes);
        $exam = Exam::where('id', $req->exam_id)
            ->first();


        try {
            $score = ScoreList::where('score_id', $exam->score_id)
                ->where('question_num', $req->right_question)
                ->first();
            // if (!isset($score->score)) {
            //     $score = json_encode(['score' => 0]);
            // }
        } catch (ErrorException $errorException) {
            $score = json_encode(['score' => 200]);
            // return response()->json([
            //     'faild'=>'This Exam Not Exists',
            //     'errorMood'=>$errorException,
            // ]);
        }
        $stu_exam = ExamHistory::create([
            'date' => now(),
            'user_id' => $user_id,
            'score' => $score->score ?? 200,
            'time' => $req->timer,
            'r_questions' => $req->right_question,
            'exam_id' => $req->exam_id,
        ]);
        if (isset($mistakes) && is_array($mistakes)) {

            try {
                foreach ($mistakes as $item) {
                    ExamMistake::create([
                        'student_exam_id' => $stu_exam->id,
                        'question_id' => $item,
                        'user_id' => $user_id,
                    ]);

                    $chapters[] = Question::where('id', $item)
                        ->with('api_lesson')
                        ->first();
                }
            } catch (QueryException $queryException) {
                return response()->json(
                    [
                        'faild' => 'The Mistakes Exam Not Found',
                        'errorMood' => $queryException,
                    ]
                );
            }
        }

        return response()->json([
            'total_score' => $exam->score,
            'pass_score' => $exam->pass_score,
            'grade' => $score->score ?? 200,
            'chapters' => $chapters,
        ]);
    }

    public function api_dia_exam_grade(Request $req)
    {


        return response()->json([
            'type' => gettype($req->mistakes),
            'mistakes' => $req->mistakes
        ]);
        $exam = DiagnosticExam::where('id', $req->exam_id)
            ->first();
        $score = ScoreList::where('score_id', $exam->score_id)
            ->where('question_num', $req->right_question)
            ->first();

        if (empty($stu_q)) {
            $stu_exam = DiagnosticExamsHistory::create([
                'date' => now(),
                'user_id' => auth()->user()->id,
                'score' => $score->score,
                'time' => $req->timer,
                'r_questions' => $req->right_question,
                'diagnostic_exams_id' => $req->exam_id,
            ]);

            foreach ($req->mistakes as $item) {
                DaiExamMistake::create([
                    'student_exam_id' => $stu_exam->id,
                    'question_id' => $item->id
                ]);
            }
        }

        return response()->json([
            'total_score' => $exam->score,
            'pass_score' => $exam->pass_score,
            'grade' => $score->score,
        ]);
    }

    public function api_get_exam_grade($id, $r_question, Request $req)
    {

        $exam = Exam::where('id', $req->exam_id)
            ->first();
        $score = ScoreList::where('score_id', $exam->score_id)
            ->where('question_num', $r_question)
            ->first();

        return response()->json([
            'total_score' => $exam->score,
            'pass_score' => $exam->pass_score,
            'grade' => $score->score,
        ]);
    }

    public function api_quiz($id)
    {
        $lesson = Lesson::where('id', $id)
        ->first();
        $quiz = $lesson->quizze_api; 
        
        foreach ($quiz as $key => $item) {
            $arr1 = [];
            foreach ( $item->question_api as $element ) {
                $element->q_url = url('images/questions/' . $element->q_url);
                $arr1[] = $element;
            }
            $item->question_api = $arr1;
        }

        return response()->json([
            'quiz' => $quiz,
        ]);
    }
    public function api_check_quiz(Request $request){
        $lesson = Lesson::where('id', $request->lesson_id)
        ->first(); // Get lesson
        $quiz = quizze::where('id', $request->quiz_id)
        ->first(); // Get quiz

        $last_quiz = $lesson->quizzes
        ->where('quizze_order', '<', $quiz->quizze_order)
        ->first();
        if ( !empty($last_quiz) ) {
            $stu_quizze = StudentQuizze::
            where('quizze_id', $last_quiz->id)
            ->where('student_id', auth()->user()->id)
            ->where('score', '>=', $last_quiz->pass_score)
            ->first();
            if ( empty($stu_quizze) ) {
                return response()->json(['faild' => 'You must pass at last quiz first']);
            }
        }
        
        $stu_quizze = StudentQuizze::
        where('quizze_id', $quiz->id)
        ->where('student_id', auth()->user()->id)
        ->where('score', '>=', $quiz->pass_score)
        ->first();
        if ( empty($stu_quizze) ) {
            return response()->json(['success' => 'open quiz']);
        }
        else{
            return response()->json(['faild' => 'You pass at quiz last']);
        }
    }

    public function api_quiz_grade(Request $req)
    {
        $quizze = quizze::where('id', $req->quizze_id)
            ->first();

        $stu_quizze = StudentQuizze::create([
            'date' => now(),
            'lesson_id' => $quizze->lesson_id,
            'quizze_id' => $quizze->id,
            'student_id' => auth()->user()->id,
            'score' => $req->score,
            'time' => $req->timer,
            'r_questions' => $req->right_question,
        ]);
        $quize_id = $stu_quizze->id;
        if ($req->mistakes == null) {
            $mistakes = [];
        } else {
            $mistakes = json_decode($req->mistakes);
        }
         
        foreach ($mistakes as $item) {
            StudentQuizzeMistake::create([
                'student_quizze_id' => $quize_id,
                'question_id' => $item,
            ]);
        }

        return response()->json([
            'success' => 'Data Is Added Successful'
        ]);
    }
 
    public function api_sign_up_page()
    {
        $countries = Country::all();
        $cities = City::all();
        return response()->json([
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    public function api_sign_up_add(Request $req)
    {
        $req->validate([
            'city_id' => 'required|numeric'
        ]);

        if ($req->password != $req->conf_password) {
            return response()->json([
                'faild' => 'Confirm Password Wrong'
            ]);
        }

        $arr = $req->only('f_name', 'l_name', 'email', 'nick_name', 'phone', 'city_id', 'grade');
        $arr['position'] = 'student';
        $arr['state'] = 'Show';
        $arr['password'] = bcrypt($req->password);
        $arr['city_id'] = (int)$req->city_id;
        $code = rand(0, 10000);

        $email = $arr['email'];
        $check = User::where('email', $email)->first();
        if (!empty($check)) {
            return response()->json([
                'email' => 'This Email Already Exist'
            ]);
        }
        $user = ConfirmSign::create([
            'code' => $code,
            'email' => $req->email,
        ]);
        Mail::To($req->email)->send(new Sign_upEmail($req->email, $code));
        $user = User::create($arr);

        $token = $user->createToken("user")->plainTextToken;
        $data = $req->all();
        $data->token = $user->token;
        LoginUser::create([
        'type' => 'mobile', 
        'user_id'=> $user->id]);

        return response()->json([
            'Success' => $data
        ]);
    }

    public function api_exam_mistakes($id){
    //     $questions = ExamMistake::where('user_id', auth()->user()->id)
    //         ->where('student_exam_id', $id)
    //         ->with('question')
    //         ->get();
    //     $arr = [];
    //     $recommandition = [];
    //     $new_arr = [];

    //     foreach ($questions as $key => $item) {
    //         $arr[] = Question::where('id', $item['question']['id'])
    //             ->with('api_lesson')
    //             ->first();
    //     }
    //     foreach ( $arr as $item ) {
    //         $item->q_url = url('images/questions/' . $item->q_url);
    //         $new_arr[] = $item;
    //     }
    //     $arr = $new_arr;

    //     foreach ($arr as $item) {
    //         $recommandition[$item['api_lesson']['api_chapter']['chapter_name']] = $item['api_lesson']['api_chapter'];
    //     }
    //     $recommandition = array_values($recommandition);

    //     return response()->json([
    //         'questions' => $questions,
    //         'recommandition' => $recommandition
    //     ]);
    
        $questions = ExamMistake::where('user_id', auth()->user()->id)
        ->where('student_exam_id', $id)
        ->with('question.api_lesson.api_chapter') // Eager load relationships to optimize performance
        ->get();

    $newArr = [];

    foreach ($questions as $question) {
        $question->question->q_url = url('images/questions/' . $question->question->q_url);
        $newArr[] = $question->question;
    }

    $recommendation = [];

    foreach ($newArr as $question) {
        $chapterName = $question->api_lesson->api_chapter->chapter_name;
        if (!isset($recommendation[$chapterName])) {
            $recommendation[$chapterName] = $question->api_lesson->api_chapter;
        }
    }

    $recommendation = array_values($recommendation);

    return response()->json([
        'questions' => $questions,
        'recommendation' => $recommendation
    ]);
    }

    public function api_dia_exam_mistakes($id)
    {

        $questions = DaiExamMistake::
            where('student_exam_id', $id)
            ->with('question')
            ->get();
        $arr = [];
        $recommandition = [];

        foreach ($questions as $key => $item) {
            $arr[] = Question::where('id', $item['question']['id'])
                ->with('api_lesson')
                ->first();
        }

        foreach ($arr as $item) {
            $recommandition[$item['api_lesson']['api_chapter']['chapter_name']] = $item['api_lesson']['api_chapter'];
        }
        $recommandition = array_values($recommandition);

        return response()->json([
            'questions' => $questions,
            'recommandition' => $recommandition
        ]);
    }

    public function api_packages()
    {
        $Exams = Package::where('module', 'Exam')
            ->get();
        $Questions = Package::where('module', 'Question')
            ->get();
        $Live = Package::where('module', 'Live')
            ->get();
        $categories = Category::get();
        $courses = Course::get();

        return response()->json([
            'Exams' => $Exams,
            'Questions' => $Questions,
            'Live' => $Live,
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }

    public function api_dia_grade(Request $req)
    {
        $exam = DiagnosticExam::where('id', $req->exam_id)
            ->first();
        $req->mistakes = json_decode($req->mistakes);

        $score = ScoreList::where('score_id', $exam->score_id)
            ->where('question_num', $req->r_question)
            ->first();
        $score = $req->r_question == 0 ? 200 : $score->score ?? 200;
        $grade = $exam->pass_score < $score ? true : false;

        $stu_q = DiagnosticExamsHistory::where('user_id', auth()->user()->id)
            ->where('diagnostic_exams_id', $exam->id)
            ->first();

        $stu_exam = DiagnosticExamsHistory::create([
            'date' => now(),
            'user_id' => auth()->user()->id,
            'diagnostic_exams_id' => $exam->id,
            'score' => $score,
            'time' => $req->timer,
            'r_questions' => $req->r_question,
        ]);

        foreach ($req->mistakes as $item) {
            DaiExamMistake::create([
                'student_exam_id' => $stu_exam->id,
                'question_id' => $item
            ]);
        }

        $arr = [];
        $recommandition = [];

        foreach ($req->mistakes as $key => $item) {
            $arr[] = Question::where('id', $item)
                ->with('api_lesson')
                ->first();
        }

        foreach ($arr as $item) {
            $recommandition[$item['api_lesson']['api_chapter']['chapter_name']] = $item['api_lesson']['api_chapter'];
        }
        $recommandition = array_values($recommandition);

        return response()->json([
            'grade' => $grade,
            'score' => $score,
            'recommandition' => $recommandition,
        ]);
    }

    public function api_payment_methods()
    {
        $payment_methods = PaymentMethod::get();

        return response()->json([
            'payment_methods' => $payment_methods
        ]);
    }

    // Start update student image
    public function update_stu_image(Request $request)
    {
        $image = $request->file('image');
        // return $image;
        if (!empty($image)) {
            $filename = $image->getClientOriginalName();

            $image->move(public_path('images/users'), $filename);
            $arr['image'] = $filename;
        } else {
            return response()->json([
                'faild' => 'Image Can\'t Be Empty',
            ], 204);
        }
        $update_student_image = User::where('id', $request->user()->id)
            ->update(['image' => $arr['image']]);
        return response()->json([
            'success' => 'Image Update Successfly ya Abo7meeed ^_^',
        ]);
    }
    // End update student image


    //  Start Make function Wallet
    public function proccess_student_wallet(Request $request)
    {
        // Check Authorized Student
        $allRequest = $request->only($this->request_wallet_student); // Take Array Protection In Request All 
        $student_id = $request->user()->id; // Get Id from Request
        // Validate Image
        $image = $request->file('image');
        if (!empty($image)) {
            $filename = $image->getClientOriginalName();
            $allRequest['image'] = $filename;
        }
        // Validate Image
        if ($request->student_id &&  $request->wallet && $request->image && $request->payment_method_id) { // If Request All About Wallet
            try {
                $allRequest['date'] = now();
                $allRequest['state'] = 'Pendding';
                $image->move(public_path('images/wallet'), $filename); // Upload Image From Wallet
                $newWallet = Wallet::where('student_id', $student_id)->create($allRequest); // Start Create New Wallet
            } catch (QueryException $th) {
                return response()->json(['faild' => 'This Data Not Found', 'queryError' => $th], 503); // if Query Has a Problem
            }
        } else {
            return response()->json(['faild' => 'All Inputs Required'], 204); // Error When inputs All Empty

        }

        if ($newWallet) {
            return response()->json(['success' => 'New Wallet Created Successfully'], 200); // Error When inputs All Empty
        }
    }
    //  End Make function Wallet 


    //  Start Make Function Wallet Hestory

    public function student_hestory_wallet(Request $request)
    {

        if (Auth::user()) { // Check User If Authorized
            // Get Student_id From Request 
            $student_id = $request->user()->id;
            // Get The Total Wallet For Student
            $getWalletStudentSum = Wallet::where('student_id', $student_id)->where('state', 'Approve')->sum('wallet');
            // Get The Total Wallet For Student

            // Get All Data About Wallets For Student
            $getWalletStudent = Wallet::where('student_id', $student_id)
                ->where('wallet', '>=', 0)->get();
            // Get All Data About Wallets For Student

            return response()->json([
                'success' => 'data returned Successfully', // Message Success 
                'totalWallet' => $getWalletStudentSum,    // Total Wallet Sum All Resharge Wallets
                'walletHestory' => $getWalletStudent      // All Data About Wallet
            ], 200);
        } else {
            return response()->json(['faild' => 'user unauhorized'], 401);
        }
    }

    public function stu_payment_wallet(Request $req)
    {
        // Promo Code
        $promo = PromoCode::where('starts', '<=', now())
            ->where('ends', '>=', now())
            ->where('num_usage', '>', 0)
            ->where('code', $req->promo_code)
            ->first();

        // Total Price of Chapters
        $price = $req->price;
        $wallet = Wallet::where('student_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->sum('wallet');
        // promo_code, module (Course, Chapter, Package), id, duration, price
        if (!empty($promo)) {
            // PromoCode Type
            $promo_state = false;
            // Package
            if ($req->type == 'package') {
                $promo_package = PromoPackage::where('promo_id', $promo->id)
                    ->where('package_id', $req->id)
                    ->first();
                $promo_state = !empty($promo_package) ? true : false;
            }
            // Chapter
            elseif ($req->type == 'Chapter') {
                $chapter_id = ($req->id);
                $chapter_id = $chapter_id[0];
                $course_id = Chapter::where('id', $chapter_id)
                    ->first()->course_id;
                $promo_course = PromoCourse::where('promo_id', $promo->id)
                    ->where('course_id', $course_id)
                    ->first();
                $promo_state = !empty($promo_course) ? true : false;
            }
            // Courses
            elseif ($req->type == 'Course') {
                $promo_course = PromoCourse::where('promo_id', $promo->id)
                    ->where('course_id', $req->id)
                    ->first();
                $promo_state = !empty($promo_course) ? true : false;
            }
            if ($promo_state) {
                $price = $req->price;
                $price = $price - $price * $promo->discount    / 100;

                if ($wallet >= $price) {
                    PromoCode::where('id', $promo->id)
                        ->update([
                            'num_usage' => $promo->num_usage - 1
                        ]);
                    UsagePromo::create([
                        'user_id' => auth()->user()->id,
                        'promo_id' => $promo->id,
                        'promo' => $req->promo_code
                    ]);
                } else {
                    return response()->json([
                        'faild' => 'You Need To Recharge Wallet'
                    ]);
                }
            }
        }

        // Wallet
        if ($wallet >= $price) {
            if ($req->type == 'Package') {
                $payment_request = PaymentRequest::create([
                    'user_id' => auth()->user()->id,
                    'price' => $price,
                    'module' => 'Package',
                    'state' => 'Approve',
                ]);
            } elseif ($req->type == 'Chapter') {
                $payment_request = PaymentRequest::create([
                    'user_id' => auth()->user()->id,
                    'price' => $price,
                    'state' => 'Approve',
                    'module' => 'Chapters',
                ]);
            } elseif ($req->type == 'Course') {
                $payment_request = PaymentRequest::create([
                    'user_id' => auth()->user()->id,
                    'price' => $price,
                    'state' => 'Approve',
                    'module' => 'Course',
                ]);
            }
            Wallet::create([
                'student_id' => auth()->user()->id,
                'wallet' => -$price,
                'date' => now(),
                'state' => 'Approve',
                'payment_request_id' => $payment_request->id,
            ]);

            // Package
            if ($req->type == 'Package') {
                $package = Package::where('id', $req->id)
                    ->first();
                PaymentPackageOrder::create([
                    'payment_request_id' => $payment_request->id,
                    'user_id' => auth()->user()->id,
                    'package_id' => $req->id,
                    'state' => 1,
                    'date' => now(),
                    'number' => $package->number,
                ]);
            }
            // Chapter
            elseif ($req->type == 'Chapter') {
                $chapter_id = ($req->id);
                $duration = ($req->duration);
                for ($i = 0, $end = count($chapter_id); $i < $end; $i++) {
                    PaymentOrder::create([
                        'payment_request_id' => $payment_request->id,
                        'chapter_id' => $chapter_id[$i],
                        'duration' => $duration[$i],
                        'state' => 1,
                        'date' => now(),
                    ]);
                }
            }
            // Courses
            elseif ($req->type == 'Course') {
                $chapters = Chapter::where('course_id', $req->id)
                    ->get();
                foreach ($chapters as $item) {
                    PaymentOrder::create([
                        'payment_request_id' => $payment_request->id,
                        'chapter_id' => $item->id,
                        'duration' => $req->duration,
                        'state' => 1,
                        'date' => now(),
                    ]);
                }
            }
        } else {
            return response()->json([
                'faild' => 'You Must Chareg Wallet'
            ]);
        }

        return response()->json([
            'Success' => 'You Are Buy Successfully'
        ]);
    }

    //  Start Checkout With Payment Method
    public function checkOut_payment_method(Request $requestsPaymentRequest, $code_id, $type, $package_id)
    {

        if ($requestsPaymentRequest->isMethod('Get')) {
            if (Auth::check()) {
                $user_id = $requestsPaymentRequest->user()->id;
                // Check if Send Code Promo
                if ($code_id) {
                    $code_promo = $code_id;
                    $checkPromo = PromoCode::where('code', $code_promo)
                        ->where('ends', '>=', now())
                        ->where('num_usage', '>', 0)
                        ->first(); // Check Code Is Exists

                    if ($checkPromo) {

                        if ($checkPromo) {
                            $code_promo_descount = $checkPromo->discount;
                            $code_promo_count = $checkPromo->num_usage;
                            if ($code_promo_count < 0) { // Check If Some Code Exists 
                                return response()->json(['faild' => 'This Code Is Not Available'], 404); // Not Found 404
                            } else {
                                // Check About Promo Is Used Befor Or No
                                $checkUsagePromo = UsagePromo::where('user_id', $user_id)->where('promo_id', $checkPromo->id)->first();
                                if ($checkUsagePromo) {
                                    return response()->json(['faild' => 'This code has been used before'], 406); // Not Found 404

                                } else {
                                    $lose_one_promo = $code_promo_count - 1;
                                    // $less_promo =  PromoCode::where('code',$code_promo)->update(['num_usage'=>$lose_one_promo]) ; // Use One Promo And Lose One From Usage Nums

                                    $model = $type == 'Package' ? $model = Package::class
                                        : ($type == 'chapter' ? $model = Chapter::class :  $model = Course::class);
                                    $checkCodeBackage = $model::where('id', $package_id);
                                    if ($type == 'course') {
                                        $checkCodeBackage->with('prices');
                                    }
                                    if ($type == 'chapter') {
                                        $checkCodeBackage->with('price');
                                    }
                                    $data = $checkCodeBackage->first();

                                    if ($data->price || $data->prices and $type != 'Package') {
                                        $price = $data->price ?? $data->prices;
                                        foreach ($price as $priceData) {
                                            $priceData->price;
                                            $coursePrice = $priceData->price;
                                        }
                                    }
                                    $totalPrice = $type == 'Package' ? $old_price = $data->price : $coursePrice;
                                    $old_price = $totalPrice; // this Is Price befor Discount

                                    // Get ModelName Where $type = $Model finaly Get Data
                                    $price_after_descount = $old_price - ($old_price * $code_promo_descount) / 100;
                                    $data->newPrice = $price_after_descount;

                                    return response()->json([
                                        'successfully' => 'Data Returned Successfully',
                                        'packageOrder' => $data->id,
                                        'type' => $data->type,
                                        'newPrice' => $data->newPrice,
                                        'duration' => $data->duration,
                                    ]);
                                }
                            }
                        }
                        return response()->json(['faild' => 'This Code Is Not Exists'], 404); // Not Found 404
                    } else {
                        return response()->json([
                            'faild' => 'This Code Is Not Found',

                        ], 400); // Not Found 404
                    }
                } else {
                    return response()->json(['faild' => 'This Code Is Not Available'], 404); // Not Found 404
                }
            }
        }  // End Get descount With package Order 



    }


    public function check_promo_chapter($type, $chapter_id, $price, $code_promo, $course_id)
    {
        if ($code_promo) {
            $chapters = json_decode($chapter_id) ?? 'Data Is Empty';
            $checkPromo = PromoCode::where('code', $code_promo)
                ->where('ends', '>=', now())
                ->where('num_usage', '>', 0)
                ->first(); // Check Code Is Exists
            if ($checkPromo) {
                for ($i = 0; $i < count($chapters); $i++) {
                    try {
                        $promo_discount = $checkPromo->id;

                        $checkPromoCourse = PromoCourse::where('course_id', $course_id)
                            ->where('promo_id', $checkPromo->id)
                            ->first();
                    } catch (errorException $errorException) {
                        return response()->json(['faild' => 'This Code Don\'t Have Promo Code']);
                    }
                    if ($checkPromoCourse) {
                        $oldPrice = $price;
                        $promo_discount = $checkPromo->discount;
                        $descount = $oldPrice - ($oldPrice * $promo_discount) / 100;
                        $totalDiscount = $descount;
                    } else {
                        return response()->json(['faild' => 'This Chapter Don\'t Have Promo Code']);
                    }
                }
            }
        } else {
            return response()->json(['faild' => 'This Code Not Found']);
        }







        return response()->json([
            'success' => 'Data Returned Successfully',
            'type' => $type,
            // 'chapter_id'=>$chapter ,
            'newPrice' => $totalDiscount,
            'coupon_code' => $code_promo,
        ]);
    }


    public function request_payment_method(PaymentHandlRequest $request)
    {
        if ($request->isMethod('POST')) {
            // Start Create Payment Request 
            $data_paymentRequest = $request->only($this->reqeust_payment_method);
            if ($request->hasFile('image')) {
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
            }
            //             $manager = new ImageManager(new Driver());
            // $image = $manager->read('images/example.jpg');

            extract($_FILES['image']);
            if (!empty($name)) {
                $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
                $extension = explode('.', $name);
                $extension = end($extension);
                $extension = strtolower($extension);
                if (in_array($extension, $extension_arr)) {
                    $img_name = rand(0, 1000) . now() . $name;
                    $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                    $data_paymentRequest['image'] = $img_name;
                }
            }
            // Image::make($image->getRealPath())->resize(200, 200)->save($path);

            $data_paymentRequest['user_id'] = $request->user()->id;
            $data_paymentRequest['module'] = $request->type;
            try {
                //code...
                $createNewPaymentRequest = PaymentRequest::create($data_paymentRequest);
            } catch (QueryException $th) {
                //throw $th;
                return response()->json([
                    'faild' => 'You Doun\'t Selected The Package',
                    'dataBaseError' => $th,
                ], 400);
            }
            if ($createNewPaymentRequest) {
                move_uploaded_file($tmp_name, 'images/payment/' . $img_name);
                $type = $request->type;
                // Start Create Payment Order 
                // i Type Package 
                if ($type == 'Package') {
                    try {
                        $getNumber = Package::select('number')->where('id', $request->id)->first();
                    } catch (QueryException $queryException) {
                        return response()->json([
                            'faild' => 'Package Not Found',
                            'dataBaseError' => $th,
                        ], 404);
                    }
                    $newOrderPackage =  $request->only($this->request_package_order);
                    $newOrderPackage['user_id'] = $request->user()->id;
                    $newOrderPackage['payment_request_id'] = $createNewPaymentRequest->id;
                    $newOrderPackage['date'] = now();
                    $newOrderPackage['number'] = $getNumber->number ?? 'Backage Not Found';
                    $newOrderPackage['package_id'] = $request->id;
                    // $newOrderPackage['package_id'] = $request->package_id;
                    try {
                        $createOrder = PaymentPackageOrder::create($newOrderPackage);
                        return response()->json(['success' => 'Payment Package Created Successfully']);
                    } catch (QueryException $th) {
                        return response()->json([
                            'faild' => 'Create Package Have Wrong',
                            'dataBaseError' => $th,
                        ], 400);
                    }
                } // End Package Payment
                // Start Course Payment

                if ($type == 'Course') {
                    $chapter_id = $request->id;
                    try {
                        $course_id = $request->id; // Get Course id 
                        $chapters = Chapter::where('course_id', $course_id)->with('price')->get(); // Start Get Chapter About This Course


                        // $paymentChapter = PaymentOrder::create($createPaymentChapter);
                        $count = 0;
                        foreach ($chapters as $chapter) {
                            $chapter_id = $chapter->id;
                            $createPaymentChapter['chapter_id'] = $chapter_id; // Get Last Payment Request
                            $createPaymentChapter['payment_request_id'] = $createNewPaymentRequest->id; // Get Last Payment Request
                            $request->duration;
                            $courseDuration = Course::where('id', $course_id)->with('prices')->first(); // Start Get Duration Course 
                            $getDuration = $courseDuration->prices->where('duration', $request->duration)->first();
                            $duration = $getDuration->duration;


                            //    $chapterGetDuration = $chapter->price->where('duration',$duration)->first();
                            //     $chapterDuration = $chapterGetDuration->duration;
                            $createPaymentChapter['duration'] = $duration; // Get Last Payment Request
                            $createNewOrder = PaymentOrder::create($createPaymentChapter);
                        }
                        return 'Success';
                        if ($paymentChapter) {
                            return response()->json(['success' => 'Payment Chapter Successfully'], 200);
                        }
                    } catch (queryException $errorException) {
                        return response()->json([
                            'faild' => 'the server cannot or will not process the request due to something that is perceived to be a client erro',
                            'error' => $errorException,

                        ], 400);
                    }
                }














                // End Course Payment






                // End Create Payment order 
            }
            // End Create Payment Request 
        } else {
            return response()->json([

                'faild' => 'The Respons Is Reqired',
            ], 404);
        }
        // Start Check out  With package Order
    }

    public function request_payment_chapter(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $image = ImageManager::imagick()->read($request->image);
        $image = $image->resizeDown(2000, 100); // 800 x 100

        // resize only image width to 200 pixel and do not exceed the origial width
        $image->resizeDown(width: 200);

        $user_id = $request->user()->id;
        $chapterRequest = $request->only($this->request_chapters_order);
        $createPaymentChapter = $request->only($this->paymentRequestChapter);

        extract($_FILES['image']);
        if (!empty($name)) {

            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if (in_array($extension, $extension_arr)) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $createPaymentChapter['image'] = $img_name;

                move_uploaded_file($tmp_name, 'images/payment/' . $img_name);
            }
        }

        $type = $request->type;
        if ($type == 'Course') {
            $createPaymentChapter['module'] = $type;
        }
        try {
            $createPaymentChapter['user_id'] = $user_id;
            $createNewPaymentRequest = PaymentRequest::create($createPaymentChapter);
        } catch (QueryException $errorException) {
            return response()->json([
                'faild' => 'the server cannot or will not process the request due to something that is perceived to be a client erro',
                'error' => $errorException,

            ], 400);
        }

        if ($type == 'Chapters') {
            $allChapter_id = json_decode($chapterRequest['id']);
            if (is_array($allChapter_id)) {
                $duration = json_decode($createPaymentChapter['duration']);
                for ($i = 0; $i < count($allChapter_id); $i++) {
                    $createPaymentChapter['payment_request_id'] = $createNewPaymentRequest->id; // Get Last Payment Request
                    $createPaymentChapter['duration'] = $duration[$i];
                    $createPaymentChapter['chapter_id'] = $allChapter_id[$i]; // This Reqeust chapter_id
                    $paymentChapter = PaymentOrder::create($createPaymentChapter);
                } // End Get Duration chapter And i will Create payment chapter !!!!
                return response()->json(['success' => 'Payment Chapter Successfully'], 200);
            } else {
                $chapter_id = $request->id;
                $createPaymentChapter['payment_request_id'] = $createNewPaymentRequest->id; // Get Last Payment Request
                $createPaymentChapter['chapter_id'] = $chapter_id; // Get Last Payment Request
                try {

                    $durationChapter = Chapter::where('id', $chapter_id)
                        ->with('price')->first(); // Get This Chapter With Prices
                    $duration = $durationChapter->price->where('duration', $request->duration)->first(); // Get Duration Where duration == request duration 
                    $createPaymentChapter['duration'] = $duration->duration; // Creat with payment Chapter Duration Chapter
                    $paymentChapter = PaymentOrder::create($createPaymentChapter);
                    if ($paymentChapter) {

                        return response()->json(['success' => 'Payment Chapter Successfully'], 200);
                    }
                } catch (ErrorException $errorException) {
                    return response()->json([
                        'faild' => 'the server cannot or will not process the request due to something that is perceived to be a client erro',
                        'error' => $errorException,

                    ], 400);
                }
            }
        }
    }
    //  End Checkout With Payment Method

    //  Start Payment Request Hestory
    public function payment_request_hestory(Request $request)
    {
        if (Auth::check()) {
            $student_id = $request->user()->id; // Get ID Student
            $getPaymentHestory = paymentRequest::where('user_id', $student_id)
                ->with('method')
                ->where('state', 'Approve')
                ->orwhere('state', 'Rejected')->get();


            return response()->json([
                'success' => 'Data Returned Successfully',
                'paymentHestory' => $getPaymentHestory,
            ]);
        } else {
            return response()->json([
                'faild' => 'User UnAuthorized',
            ]);
        }
    }


    //  End  Payment Request Hestory


    // Start  customer_category 
    public function customer_category(Request $request)
    {
        $categories = Category::with('courses')->get();
        if ($categories) {
            foreach ($categories as $category) {

                $category->cate_url   = url('images/category/' . $category->cate_url); // Get Category Image Url

                // Start Get Url Course  
                $courses = $category->courses;
                foreach ($courses as $course) { // End Get Url Course
                    $course->course_url = url('images/courses/' . $course->course_url);
                    foreach ($course->chapterWithPrice as $chapterImage) { // Start Get Url Chapter
                        $chapterImage->ch_url = url('images/Chapters/' . $chapterImage->ch_url); // Get Category Image Url
                    } // Start Get Url Chapter
                } // End Get Url Course
            }
        }
        //chapter_with_price
        return response()->json([
            'success' => 'Data Returned Successfully',
            'category' => $categories,
        ], 200);
    }
    // End  customer_category 


    public function delete_account(Request $request)
    {
        $user = $request->user(); // Get Data Of User 
        $user_id = $request->user()->id; // Get user Id
        $deleteStudent = User::where('id', $user_id)->where('position', 'student')->update(
            [
                'state' => 'hidden',
            ]
        );
        if (empty($user)) {
            return response()->json(['faild' => 'You are not Login'], 403);
        }
        if ($deleteStudent) {
            if ($user->tokens()->delete()) {
                return response()->json(['success' => 'Email Deleted Successfully'], 200);
            }
        }
    }

    public function forget_password(Request $req)
    {
        $user = User::where('email', $req->user)
            ->orWhere('phone', $req->user)
            ->first();

        if (!empty($user)) {
            $code = rand(100000, 999999);
            ForgetPassword::create([
                'user_id' => $user->id,
                'code' => $code,
            ]);

            Mail::To($user->email)->send(new ForgetPasswordEmail($user->id, $code));
        } else {
            return response()->json([
                'faild' => 'Email or Phone is Wrong'
            ]);
        }
    }

    public function confirm_code(Request $req)
    {
        $user = User::where('email', $req->user)
            ->orWhere('phone', $req->user)
            ->first();

        $confirm = ForgetPassword::where('user_id', $user->id)
            ->where('code', $req->code)
            ->first();

        if (!empty($confirm)) {
            return response()->json([
                'success' => 'Congratulations Code Is Right'
            ]);
        } else {
            return response()->json([
                'faild' => 'Code Is Wrong'
            ]);
        }
    }

    public function update_password(Request $req)
    {
        $user = User::where('email', $req->user)
            ->orWhere('phone', $req->user)
            ->first();

        $confirm = ForgetPassword::where('user_id', $user->id)
            ->where('code', $req->code)
            ->first();

        if (!empty($confirm)) {

            $user->update(['password' => bcrypt($req->password)]);

            return response()->json([
                'success' => 'You Updated Your Password Success'
            ]);
        } else {
            return response()->json([
                'faild' => 'Code Is Wrong'
            ]);
        }
    }

    // Start Live Request With Student 

    public function session_request(Request $request)
    {
        try {
            $sessionData = [];
            $request_live_session = $request->only($this->live_session_request);

            $session = Category::where('id', $request_live_session['category_id'])
                ->with('courses_live', function ($query) {
                    $query->with('chapter', function ($query) {
                        $query->with('lessons', function ($query) {
                            $query->with('sessions');
                        });
                    });
                })->first(); // Get Category  &  Course  &  Chapter  &  Lesson  &  Live Session

            $session->courses->where('id', $request_live_session['course_id']); //Get Course Where ID == $request Course_id
            $endDate = $request->end_date;
            foreach ($session->courses_live as $data) { // Get Course 
                foreach ($data->chapter as $chapter) { // Get Chapter
                    foreach ($chapter->lessons as $lesson) { // Get Lesson
                        $today = Carbon::now();
                        $sessionAvillable = $lesson->sessions
                            ->whereBetween('date', [$today->format('Y-m-d'), $endDate]); // Filter Session Time Now to $end_date
                        foreach ($sessionAvillable as $session_now) {
                            if (!empty($session)) {

                                if (!empty($lesson->sessions)) {
                                    $sessionData[] = [
                                        'chapter' => $chapter->chapter_name,
                                        'lessonSessions' => $lesson->lesson_name,
                                        'sessionData' => $session_now,

                                    ];
                                }
                            }
                        }
                    }
                }
            }
            return response()->json([
                'success' => 'Data Returned Successfully',
                'category' => $session->cate_name,
                'liveRequest' => [
                    $sessionData
                ],
            ]);
        } catch (ErrorException) {

            return response()->json([
                'faild' => 'Not Found Request To Get Data'
            ], 400);
        }
    }
    public function session_private_request(Request $request)
    {

        try {
            $request_live_session = $request->only($this->live_session_request);

            $session = Category::where('id', $request_live_session['category_id'])
                ->with('courses_live', function ($query) {
                    $query->with('chapter', function ($query) {
                        $query->with('lessons', function ($query) {
                            $query->with('sessions', function ($query) {
                                $query->where('type', 'private');
                            });
                        });
                    });
                })->first(); // Get Category  &  Course  &  Chapter  &  Lesson  &  Live Session

            $session->courses->where('id', $request_live_session['course_id']); //Get Course Where ID == $request Course_id
            $endDate = $request->end_date;
            $sessionData = [];
            foreach ($session->courses_live as $data) { // Get Course 
                foreach ($data->chapter as $chapter) { // Get Chapter
                    foreach ($chapter->lessons as $lesson) { // Get Lesson
                        $today = Carbon::now();
                        $sessionAvillable = $lesson->sessions
                            ->whereBetween('date', [$today->format('Y-m-d'), $endDate]); 
                            // Filter Session Time Now to $end_date
                            if ( count($sessionAvillable) > 0 ) {
                                foreach ($sessionAvillable as $session_now) {
                                    if (!empty($session)) {
        
                                        if (!empty($lesson->sessions)) {
                                            $sessionData[] = [
                                                'chapter' => $chapter->chapter_name,
                                                'lessonSessions' => $lesson->lesson_name,
                                                'sessionData' => $session_now,
        
                                            ];
                                        }
                                    }
                                }
                            }
                    }
                }
            }
            return response()->json([
                'success' => 'Data Returned Successfully',
                'category' => $session->cate_name,
                'liveRequest' => [
                    $sessionData
                ],
            ]);
        } catch (ErrorException) {

            return response()->json([
                'faild' => 'Not Found Request To Get Data'
            ], 400);
        }
    }

    public function booking_private_session(Request $req)
    {
        SessionStudent::create([
            'session_id' => $req->session,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'success' => 'You Are Booking Success'
        ]);
    }
    // public function session_private_request(Request $request){

    //     try{
    //         $request_live_session = $request->only($this->live_session_request);

    //         $session = Category::where('id', $request_live_session['category_id'])
    //             ->with('courses_live', function ($query) {
    //                 $query->with('chapter', function ($query) {
    //                     $query->with('lessons', function ($query) {
    //                         $query->with('sessions', function ($query) {
    //                             $query->where('type', 'private');
    //                         });
    //                     });
    //                 });
    //   })->first(); // Get Category  &  Course  &  Chapter  &  Lesson  &  Live Session
    //    $session->courses->where('id',$request_live_session['course_id']); //Get Course Where ID == $request Course_id
    //         $endDate =$request->end_date;
    //                foreach ($session->courses_live as $data){ // Get Course 
    //                      foreach($data->chapter as $chapter){ // Get Chapter
    //                              foreach($chapter->lessons as $lesson){ // Get Lesson
    //                     $today = Carbon::now();
    //                       $sessionAvillable = $lesson->sessions
    //                         ->whereBetween('date',[ $today->format('Y-m-d'),$endDate]); // Filter Session Time Now to $end_date
    //                                     if(!empty( $lesson->sessions)){
    //                              $sessionData []=[
    //                                 'chapter' =>$chapter->chapter_name,
    //                                     'lessonSessions' => $lesson->lesson_name,
    //                                         'sessionData'=>  $sessionAvillable,

    //                             ];
    //                         }
    //                     }
    //                 }
    //             } 
    //                 return response()->json([
    //                     'success'=>'Data Returned Successfully',
    //                          'liveRequest'=>[
    //                             $session->cate_name,
    //                                 $sessionData
    //                          ],
    //                 ]);
    //     }catch(ErrorException){

    //         return response()->json([
    //                 'faild'=>'Not Found Request To Get Data'
    //         ],400);

    //     }


    // }

    public function myLive_session(Request $request)
    {

        $user_id = $request->user()->id;
        try {
            $myLiveSessions = SessionAttendance::where('user_id', $user_id)
                ->with('session', function ($query) {
                    $query->with('lesson', function ($query) {
                        $query->with('ideas');
                    });
                })->get();

                if ($myLiveSessions) {

            foreach ($myLiveSessions as $myLiveSession) {
                $session = $myLiveSession->session;
                $lesson = $session->lesson;
                    $lesson->lesson_url = url('images/lesson/'.$lesson->lesson_url);
                foreach ($lesson->ideas as $ideas) {
                    $ideas->pdf = url('file/lessons_pdf/' . $ideas->pdf);
                }
                //  $course = $chapter->course->select(''); 
                      $lesson->chapterMyLive->ch_url = url('images/Chapters/'.$lesson->chapterMyLive->ch_url);
            }
            
        
        }
        } catch (ErrorException  $errorException) {
            return response()->json([
                'faild' => 'You Don\'t Have any Session',
                'errorMessage' => $errorException,
            ]);
        }
        
        return response()->json([
            'success' => 'Data Returned Successfully',
            'myLiveSession' => $myLiveSessions
        ]);
    }

    public function stu_quiz_mistakes( $id, Request $req ){
        $mistakes = StudentQuizzeMistake::
        where('student_quizze_id', $id)
        ->with('question')
        ->get();
        foreach ($mistakes as $item) {
            $item->question->q_url = url('images/questions/' . $item->question->q_url);
        }

        return response()->json([
            'mistakes' => $mistakes,
        ]);
    }
    

    public function lesson_score_sheet_api( $id, Request $req ) {
        $data = StudentQuizze::
        where('student_id', auth()->user()->id)
        ->where('lesson_id', $id)
        ->with(['quizze', 'questions'])
        ->get();
        foreach ( $data as $key => $item ) {
            foreach ( $item->questions as $key => $element ) {
                $element->q_url = url('images/questions/' . $element->q_url);
            }
        }
        $arr = [];

        foreach ( $data as $item ) {
            $arr[$item->quizze_id] = $item;
        }

        return response()->json([
            'data' => array_values($arr)
        ]);
    }

    public function api_q_code(){
        $codes = ExamCodes::all();

        return response()->json([
            'codes' => $codes
        ]);
    }

}
