<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     //admin and students list
     public function list() {
        return view('admin.list',[
            'all' => User::where('user_name', 'LIKE', '%'.request()->search . '%')
                            ->orWhere('email', 'LIKE', '%'.request()->search . '%')
                            ->paginate(5)->withQueryString()
        ]);
    }

    //show
    public function show($role) {
        return view('admin.list',[
            'all' => User::where('role',$role)->paginate(5)->withQueryString(),
            'currentRole' => $role,
        ]);
    }

    //delete
    public function delete($id) {
        User::find($id)->delete();
        return redirect()->route('list')->with('success','Account deleted successfully!');
    }

    //update
    public function update($id) {
        $each = User::where('id',$id)->first();
        // dd($each->role);
        if($each->role == 'User') {
            $roleUpdate = ['role'=> 'admin'];
            User::where('id',$id)->update($roleUpdate);
            return redirect()->route('list')->with('success','Account changed to admin role successfully!');
        }else {
            $roleUpdate = ['role'=> 'user'];
            User::where('id',$id)->update($roleUpdate);
            return redirect()->route('list')->with('success','Account changed to user role successfully!');
        }

    }
}
