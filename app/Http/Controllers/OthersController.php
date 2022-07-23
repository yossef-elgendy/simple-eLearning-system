<?php

namespace App\Http\Controllers;

use App\Mail\QuestionMail;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OthersController extends Controller
{
    public function aboutUs()
    {
        return view('AboutUs');
    }

    public function contactUs()
    {
        return view('ContactUs');
    }

    public function sendQuestionMail(Request $request)
    {

        $request->validate([
           'name'=>'required|string',
           'email'=>'required|email',
           'msg'=>'required',
           'subject'=>'required',
        ]);

        Question::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'subject'=>$request->input('subject'),
            'msg'=>$request->input('msg'),
            'phone'=>$request->input('phone'),
            ]);

        $data = [
            'from'=>$request->input('email'),
            'subject'=>$request->input('subject'),
            'body'=>$request->input('msg'),
            'name'=>$request->input('name'),
        ];

        Mail::to('yossef.elgendy55@gmail.com')->send(new QuestionMail($data));

        return redirect()->back()->with('success');

    }


}
