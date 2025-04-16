<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Package;
use App\Models\Session;
use App\Models\Category;
use App\Models\Affilate; 
use App\Models\UserAdmin;
use App\Models\Admin_role;
use App\Models\PaymentRequest;
use App\Models\Lesson; 
use App\Models\Commission; 
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name',
        'f_name',
        'l_name',
        'nick_name',
        'city_id',
        'grade',
        'email',
        'phone',
        'parent_phone',
        'parent_email',
        'image',
        'position',
        'user_admin_id',
        'password',
        'last_login_at',
        'last_login_ip',
        'profile_photo_path',
        'course_id',
        'category_id',
        'extra_email',
        'exam_number',
        'q_number',
        'state',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        return $this->profile_photo_path;
    }
    
    public function teacher_courses()
    {
        return $this->belongsToMany(Course::class, 'teacher_courses');
    }
    
    public function package()
    {
        return $this->belongsToMany(Package::class, 'user_packages');
    }
    
    public function courses_live()
    {
        return $this->belongsToMany(Course::class, 'live_courses');
    }
    
    public function student_sessions()
    {
        return $this->belongsToMany(Course::class, 'student_sessions', 'student_id', 'course_id');
    }
    
    public function attendance( $id )
    {
        return $this->belongsToMany(Lesson::class, 'live_lessons')
        ->where('lessons.id', $id );
    }
    
    
    public function user_admin()
    {
        return $this->belongsTo(UserAdmin::class, 'user_admin_id');
    }
    
    public function course_live_item( $course_id )
    {
        return $this->belongsToMany(Course::class, 'live_courses')
        ->where('courses.id', $course_id);
    }
    
    public function roles()
    {
        return $this->hasMany(Admin_role::class, 'user_id');
    }
    
    public function affilate()
    {
        return $this->hasMany(Affilate::class, 'user_id')->first();
    }
    
    public function session_attendance()
    {
        return $this->belongsToMany(Session::class, 'session_attendance');
    }
    
    public function session_explanation()
    {
        return $this->belongsToMany(Session::class, 'session_attendance')
        ->where('session_types', 'explanation');
    }
    
    public function session_re_explanation()
    {
        return $this->belongsToMany(Session::class, 'session_attendance')
        ->where('session_types', 're_explanation');
    }
    
    public function session_mistakes()
    {
        return $this->belongsToMany(Session::class, 'session_attendance')
        ->where('session_types', 'mistakes');
    }
    
    public function private_session()
    {
        return $this->belongsToMany(Session::class, 'session_students')
        ->where('type', 'private');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function payment_req_approve()
    {
        return $this->hasMany(PaymentRequest::class, 'user_id')
        ->where('state', 'Approve');
    }

    public function getDefaultAddressAttribute()
    {
        return $this->addresses?->first();
    }

    public function extraDays()
    {
    return $this->hasMany(LessonExtraDays::class);
    }
}
