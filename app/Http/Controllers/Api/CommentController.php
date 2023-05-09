<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //store user comment
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'body' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ],422);
        };


        Comment::create([
            'body' => request('body'),
            'user_id' => request('userId'),
            'course_id' => request('courseId')
        ]);

        return response()->json(['success' => true]);




    }
}
