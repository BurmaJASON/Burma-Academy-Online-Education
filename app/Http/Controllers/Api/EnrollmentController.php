<?php

namespace App\Http\Controllers\Api;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{
    //enrollments
    public function index() {
        $enrollments = Enrollment::latest()->get();

        return response()->json([
            'enrollments' => $enrollments,
            'success' => true
        ]);
    }

    //enrollments of user
    public function userEnrolls($id) {
        $enrollments = Enrollment::where('user_id',$id)->latest()->get();

        return response()->json([
            'enrollments' => $enrollments,
            'success' => true
        ]);
    }

    // enroll
    public function store() {
        $data = [
            'user_id' => request('userId'),
            'course_id' => request('courseId'),
        ];
        Enrollment::create($data);
        return response()->json(['success' => true]);
    }

    //delete enrollment
    public function delete() {
        Enrollment::where('course_id',request('courseId'))
                    ->where('user_id',request('userId'))
                    ->delete();
        return response()->json([
                'enrollments' => Enrollment::latest()->get(),
                'success' => true
        ]);
    }
}
