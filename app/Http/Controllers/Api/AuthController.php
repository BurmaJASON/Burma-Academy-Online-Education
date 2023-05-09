<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //user register
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => request()->name,
            'user_name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
            'role' => 'user'
        ];

        User::create($data);

        $user = User::where('email', request()->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }


    //user login
    public function login() {
        $user = User::where('email',request()->email)->first();

        if(isset($user)) {
            if(Hash::check(request()->password,$user->password)) {
                return response()->json([
                    'status' => true,
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken,
                ]);
            }else {
                return response()->json([
                    'status' => false,
                    'user' => null,
                    'token' => null
                ]);
            }
        }
    }


    //all counting for about view
    public function count() {
        return response()->json([
            'subjects' => Category::count(),
            'courses' => Course::count(),
            'instructors' => User::where('role','admin')->count(),
            'users' => User::where('role','user')->count(),
        ]);
    }

}
