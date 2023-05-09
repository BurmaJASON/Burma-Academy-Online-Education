<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;

class ProfileController extends Controller
{

    // dahboard index view
    public function index () {

        return view('dashboard',[
            'courses' =>Course::all(),
            'earning' => Enrollment::with('course')->where('status', 1)->get()->pluck('course.price')->sum(),
            'views' => Course::select('view_count')->get()->pluck('view_count')->sum(),
            'students' => User::where('role','user')->latest()->take(6)->get(),
            'enrollments' => Enrollment::latest()->take(7)->get(),
            'categories' => Category::all(),
            'comments' => Comment::count()
        ]);
    }

    //admin profile edit view
    public function edit() {
        return view('admin.edit');
    }

    //admin profile update
    public function update() {
        $this->accountValidationCheck();
        $data = $this->getUserData();

        //for image
        if(request()->hasFile('image')) {
            $dbImage = User::where('id',Auth::user()->id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null) {
                File::delete(storage_path('app/public/profileImage/').$dbImage);
            }


            $fileName = uniqid().request()->file('image')->getClientOriginalName();

            request()->file('image')->move(storage_path('app/public/profileImage'),$fileName);

            $data['image'] = $fileName;
        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('dashboard')->with(['success'=> 'Your account is successfully updated!']);
    }

    //admin password direct page
    public function directChangePass() {
        return view('admin.password');
    }

    //password change
    public function changePassword() {

        // Validate the request data
        $validator = $this->PasswordValidationCheck();

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        if(Hash::check(request()->input('currentPassword'),$dbPassword)) {

            // Update the user's password
            $userNewPassword = Hash::make(request()->input('newPassword'));

            $updateUser = [
                'password' => $userNewPassword,
                'updated_at' => Carbon::now(),
            ];

            User::where('id',Auth::user()->id)->update($updateUser);


            return redirect('dashboard')->with('success', 'Your Password is successfully updated!');
        }else {
            return back()->with('passUpdateFail','Old Password Do no Match!');
        }
    }

    // accoutn validation check
    private function accountValidationCheck() {
        Validator::make(request()->all(),[
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'image' => 'mimes:png,jpg,jpeg,webp|file'
        ])->validate();
    }

    // request user data
    private function getUserData() {
        return [
            'name' => request()->name,
            'user_name' => request()->username,
            'email' => request()->email,
            'gender' => request()->gender,
            'updated_at' => Carbon::now()
        ];
    }

    // PasswordValidationCheck
    private function PasswordValidationCheck() {
        return Validator::make(request()->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword'
        ],[
            'confirmPassword.same' => 'Confirm Password is not match with new password!'
        ]);
    }


}
