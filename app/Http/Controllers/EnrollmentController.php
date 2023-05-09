<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    //enrollments
    public function index() {
        return view('enrollment.index',[
            'all' => Enrollment::latest()
                    ->orWhereHas('course', function($query) {
                        $query->where('title', 'LIKE', '%'.request('search').'%');
                    })
                    ->orWhereHas('user', function($query) {
                        $query->where('user_name', 'LIKE', '%'.request('search').'%');
                    })
                    ->paginate(7)
                    ->withQueryString()
        ]);
    }

    //show
    public function show($status) {
        $currentStatus = '';
        if($status == 0) {
            $currentStatus = "Pending";
        }else if ($status == 1) {
            $currentStatus = "Accepted";
        }else {
            $currentStatus = "Rejected";
        }
        return view('enrollment.index',[
            'all' => Enrollment::where('status',$status)->paginate(7)->withQueryString(),
            'currentStatus' => $currentStatus
        ]);
    }

    //accept
    public function accept($id) {
        $data = [
            'status' => 1
        ];

        Enrollment::where('id',$id)->update($data);
        return redirect()->route('enrollments');
    }

    //reject
    public function reject($id) {
        $data = [
            'status' => 2
        ];

        Enrollment::where('id',$id)->update($data);
        return redirect()->route('enrollments');

    }
}
