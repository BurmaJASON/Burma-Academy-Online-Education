<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CourseController extends Controller
{
    //get all courses
    public function index() {

        $coursePerPage = 6;
        $courses = Course::latest()
                    ->where('title', 'LIKE', '%'.request()->search . '%')
                    ->orWhere('price', 'LIKE', '%'.request()->search . '%')
                    ->orWhereHas('category', function($query) {
                            $query->where('name', 'LIKE', '%'.request('search').'%');
                        })
                    ->orWhereHas('instructor', function($query) {
                        $query->where('user_name', 'LIKE', '%'.request('search').'%');
                    })->simplePaginate($coursePerPage);

                    $pageCount = count(Course::all()) / $coursePerPage;


        $allCourses = Course::latest()
                    ->where('title', 'LIKE', '%'.request()->search . '%')
                    ->orWhere('price', 'LIKE', '%'.request()->search . '%')
                    ->orWhereHas('category', function($query) {
                            $query->where('name', 'LIKE', '%'.request('search').'%');
                        })
                    ->orWhereHas('instructor', function($query) {
                        $query->where('user_name', 'LIKE', '%'.request('search').'%');
                    })->get();

        return response()->json([
            'courses' => $courses,
            'allCourses' => $allCourses,
            'categories' => Category::all(),
            'status' => 'good success',
            'pageCount' => ceil($pageCount)
        ]);
    }

    //add view count
    public function viewCount(Request $request) {
        $course = Course::where('slug', $request->input('courseSlug'))->first();
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }
        $course->increment('view_count');
        return response()->json(['success' => true]);
     }
}
