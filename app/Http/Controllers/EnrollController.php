<?php

namespace App\Http\Controllers;

use App\Course;
use App\Specification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $courses = Course::where('deleted_at',null)->get();
        return view('students.index',compact('courses'));
    }

    public function myCourses()
    {
        $user = User::where('id',auth()->user()->id)->first();
        $courses = $user->courses_st()->get();
        return view('students.myCourses',compact('courses'));
    }

    public function show(Course $course){

        $students = $course->students()->wherePivot('course_id',$course->id)
            ->wherePivot('feedBack','<>',null)->get();

        $feedback = $course->students()
            ->wherePivot('user_id',auth()->user()->id)
            ->wherePivot('course_id',$course->id)
            ->get();

        return view('students.show',compact('course','students','feedback'));


    }


    public function dropout(Course $course)
    {

        if(!count($course->students()->where('user_id',auth()->user()->id)->get()))
        {
            return json_encode(array('status'=>false));
        }

        $course->students()->detach(auth()->user()->id);
        return json_encode(array('status'=>true));

    }


    public function enroll(Course $course)
    {
        if(count($course->students()->where('user_id',auth()->user()->id)->get()))
        {
            return json_encode(array('status'=>false));
        }

        $course->students()->attach(auth()->user()->id);
        return json_encode(array('status'=>true));


    }


    public function storeFeedBack(Request $request , Course $course)
    {


        $user = User::find(auth()->user()->id);
        $course->students()->updateExistingPivot($user,array('feedBack'=>$request->feedBack),false);
        $feedback = $course->students()
            ->wherePivot('user_id',$user->id)
            ->wherePivot('course_id',$course->id)
            ->get();


        return json_encode(array('user'=>$user,
            'feedback'=>$feedback[0]->pivot));
    }

    public function deleteFeedBack(Course $course)
    {
        $user = User::find(auth()->user()->id);
        $course->students()->updateExistingPivot($user,array('feedBack'=>null),false);

        return redirect()->back()->with('status','Hi');
    }



}
