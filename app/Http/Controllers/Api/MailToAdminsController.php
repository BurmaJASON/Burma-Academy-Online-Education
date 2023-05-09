<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailToAdminsController extends Controller
{
    //send mail
    public function send(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required'],
            'body' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $mailData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
        ];

        $receivers = User::where('role','admin')->get();

        $receivers->each(function($receiver) use ($mailData) {
            Mail::to($receiver->email)->queue(new ContactMail($mailData));
        });

        return response()->json([
            'receivers'=> $receivers,
            'status' => 'success'
        ]);
    }
}
