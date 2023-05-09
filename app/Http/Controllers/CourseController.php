<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //index
    public function index() {
        return view('course.index',[
            'courses' => Course::latest()
                                ->where('title', 'LIKE', '%'.request()->search . '%')
                                ->orWhere('price', 'LIKE', '%'.request()->search . '%')
                                ->orWhereHas('category', function($query) {
                                        $query->where('name', 'LIKE', '%'.request('search').'%');
                                    })
                                ->orWhereHas('instructor', function($query) {
                                    $query->where('user_name', 'LIKE', '%'.request('search').'%');
                                })
                                ->paginate(4)
                                ->withQueryString()
        ]);
    }

    //course create page
    public function createPage() {
        return view('course.create',[
            'categories' => Category::all()
        ]);
    }

    //course create
    public function createCourse() {
        // dd(request()->all());
        $this->checkCourseValidation();
        if(!empty(request()->image)) {
            $imgFile = request()->file('image');
            $imgName = uniqid().'_'.$imgFile->getClientOriginalName();

            $imgFile->move(storage_path('app/public/courseImage'),$imgName);

            $postData = $this->getPostData($imgName);
        }else {
            $postData = $this->getPostData(null);
        }

        Course::create($postData);
        return redirect()->route('course')->with(['success' => 'New Course is created successfully!']);
    }

    //course delete
    public function deleteCourse($id) {
        Course::find($id)->delete();
        return back()->with('success', 'You deleted the course successfully!');
    }

    //course show
    public function show(Course $course) {
        return view('course.show',[
            'course' => $course
        ]);
    }

    // course edit
    public function editCourse(Course $course) {
        return view('course.edit',[
            'course' => $course,
            'categories' => Category::all()
        ]);
    }

    //course update
    public function updateCourse($id) {
        $this->checkCourseValidation();
        $data = $this->updatePostData();

        if(!empty(request()->image)) {
            // dd(request()->all());
            $this->storeNewUpdateImage($id);
        }else {
            Course::where('id', $id)->update($data);
        }

        return redirect()->route('course')->with('success','Your course is updated successfully!');
    }


    //course validation check
    private function checkCourseValidation() {
        return Validator::make(request()->all(),[
            'title' => 'required',
            'category' => 'required',
            'intro' => 'required',
            'body' => 'required',
            'image' => 'mimes:png,jpg,jpeg,gif,webp|file',
        ])->validate();
    }

    //get post data
    private function getPostData($imgFile) {
        return [
            'title' => request()->title,
            'category_id' => request()->category,
            'intro' => request()->intro,
            'body' => request()->body,
            'price' => request()->price ? request()->price : 0,
            'image' => $imgFile,
            'user_id' => Auth()->user()->id,
            'slug' =>  fake()->unique()->slug(),
        ];
    }

    //get update data
    private function updatePostData() {
        return [
            'title' => request()->title,
            'category_id' => request()->category,
            'intro' => request()->intro,
            'body' => request()->body,
            'price' => request()->price ? request()->price : 0,
            // 'user_id' => Auth()->user()->id,
            // 'slug' =>  fake()->unique()->slug(),
        ];
    }

    //store new update image
    private function storeNewUpdateImage($id) {
        //get image from user
        $imgFile = request()->file('image');
        $imgName = uniqid().'_'.$imgFile->getClientOriginalName();

        //get image from db
        $courseData = Course::where('id', $id)->first();
        $dbImage = $courseData->image;

        //delete image from storage
        if(File::exists(storage_path('app/public/courseImage/').$dbImage)) {
            File::delete(storage_path('app/public/courseImage/').$dbImage);
        }

        //store new image in storage
        $imgFile->move(storage_path('app/public/courseImage'),$imgName);

        //update data with new Image
        $data['image'] = $imgName;
        Course::where('id', $id)->update($data);
    }
}
