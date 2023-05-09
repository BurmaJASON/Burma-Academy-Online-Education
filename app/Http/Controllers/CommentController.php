<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //index
    public function index() {
        return view('comment.index', [
            'courses' => Course::whereIn('id', function ($query) {
                            $query->select('course_id')
                                ->from('comments');
                        })
                        ->where(function ($query) {
                            $query->where('title', 'LIKE', '%'.request()->search . '%')
                                ->orWhere('price', 'LIKE', '%'.request()->search . '%')
                                ->orWhereHas('category', function($query) {
                                        $query->where('name', 'LIKE', '%'.request('search').'%');
                                    })
                                ->orWhereHas('instructor', function($query) {
                                    $query->where('user_name', 'LIKE', '%'.request('search').'%');
                            });
                        })
                        ->withCount('comments')
                        ->latest()
                        ->paginate(4)
                        ->withQueryString()
        ]);
    }

    //show
    public function show($courseId) {
        return view('comment.show',[
            'comments' => Comment::where('course_id',$courseId)
                                ->where(function ($query) {
                                    $query->where('body', 'LIKE', '%'.request()->search . '%')
                                        ->orWhereHas('author', function($query) {
                                            $query->where('user_name', 'LIKE', '%'.request('search').'%');
                                        });
                                })
                                ->latest()
                                ->paginate(5)
                                ->withQueryString()
        ]);
    }

    //delete
    public function delete($id) {
        Comment::where('id',$id)->delete();
        return redirect()->back()->with(['success' => 'Comment is deleted successfully!']);
    }
}
