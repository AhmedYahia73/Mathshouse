<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $explanation_lessons = $this->session_explanation->flatten(1)
        ->pluck('lesson')->unique('id'); 
        $explanation_chapters = $explanation_lessons->pluck('chapter')->unique('id');
        $explanation_courses = $explanation_chapters->pluck('course')->unique('id');
        $explanation_categories = $explanation_courses->pluck('category')->unique('id');
        $re_explanation_lessons = $this->session_re_explanation->flatten(1)
        ->pluck('lesson')->unique('id'); 
        $re_explanation_chapters = $re_explanation_lessons->pluck('chapter')->unique('id');
        $re_explanation_courses = $re_explanation_chapters->pluck('course')->unique('id');
        $re_explanation_categories = $re_explanation_courses->pluck('category')->unique('id');
        $mistakes_courses = $this->session_mistakes->flatten(1)
        ->pluck('course')->unique('id');
        $mistakes_categories = $mistakes_courses->pluck('category')->unique('id');

        $lessons = $explanation_lessons->merge($re_explanation_lessons)->unique('id');
        $chapters = $explanation_chapters->merge($re_explanation_chapters)->unique('id');
        $courses = $explanation_courses->merge($re_explanation_courses, $mistakes_courses)->unique('id');
        $categories = $explanation_categories->merge($re_explanation_categories, $mistakes_categories)->unique('id');
        if ($this->session_explanation) {
            return [
                'id' => $this->id,
                'nick_name' => $this->nick_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'image' => url($this->image),
                'sessions_explanation_count' => count($this->session_explanation),
                'sessions_re_explanation_count' => count($this->session_re_explanation),
                'sessions_mistakes_count' => count($this->session_mistakes),
                'students_explanation_count' => $this->session_explanation->sum('student_count') - count($this->session_explanation),
                'students_re_explanation_count' => $this->session_re_explanation->sum('student_count') - count($this->session_re_explanation),
                'students_mistakes_count' => $this->session_mistakes->sum('student_count') - count($this->session_mistakes),
                'categories' => $categories,
                'courses' => $courses,
                'chapters' => $chapters,
                'lessons' => $lessons,
            ];
        }
        elseif ($this->session_re_explanation) {
            return [
                'id' => $this->id,
                'nick_name' => $this->nick_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'image' => url($this->image),
                'sessions_explanation_count' => count($this->session_explanation),
                'sessions_re_explanation_count' => count($this->session_re_explanation),
                'sessions_mistakes_count' => count($this->session_mistakes),
                'students_explanation_count' => $this->session_explanation->sum('student_count') - 1,
                'students_re_explanation_count' => $this->session_re_explanation->sum('student_count') - 1,
                'students_mistakes_count' => $this->session_mistakes->sum('student_count') - 1,
                'categories' => $categories,
                'courses' => $courses,
                'chapters' => $chapters,
                'lessons' => $lessons,
            ];
        }
        elseif ($this->session_mistakes) {
            return [
                'id' => $this->id,
                'nick_name' => $this->nick_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'image' => url($this->image),
                'sessions_explanation_count' => count($this->session_explanation),
                'sessions_re_explanation_count' => count($this->session_re_explanation),
                'sessions_mistakes_count' => count($this->session_mistakes),
                'students_explanation_count' => $this->session_explanation->sum('student_count') - 1,
                'students_re_explanation_count' => $this->session_re_explanation->sum('student_count') - 1,
                'students_mistakes_count' => $this->session_mistakes->sum('student_count') - 1,
                'categories' => $categories,
                'courses' => $courses,
            ];
        }
    }
}
