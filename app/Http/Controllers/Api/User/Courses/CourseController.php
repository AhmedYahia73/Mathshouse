<?php

namespace App\Http\Controllers\Api\User\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CourseController extends Controller
{
    public function __construct(private Category $categories){}

    public function lists(Request $request){
        $categories = $this->categories
        ->with(['courses.chapter.lessons'])
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'category_name' => $item->cate_name,
                'category_description' => $item->cate_des,
                'category_image' => $item->image_link,
                'teacher' => $item?->teacher?->nick_name,
                'course' => $item?->courses?->map(function($element){
                    return [
                        'id' => $element->id,
                        'price' => $element?->prices?->min('price'),
                        'course_name' => $element->course_name,
                        'course_description' => $element->course_des,
                        'course_image' => $element->image_link,
                        'teacher' => $element?->teacher?->nick_name,
                        'chapters' => $element->chapter->map(function($item2){
                            return [
                                'id' => $item2->id,
                                'chapter_price' => $item2?->price?->min('price'),
                                'chapter_name' => $item2->chapter_name,
                                'lessons' => $item2->lessons
                                ->map(function($element2){
                                    return [
                                        'id' => $element2->id,
                                        'lesson_name' => $element2->lesson_name,
                                    ];
                                })
                            ];
                        })
                    ];
                }),
            ];
        });

        return response()->json([
            'categories' => $categories
        ]);
    }
}
