<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Specification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $courses = DB::table('courses')
            ->join('specifications','specifications.id','=','courses.specification_id')
            ->select(DB::raw('specifications.name as specName,courses.name as courseName, courses.id, duration, content,user_id '))
            ->where([['user_id','=',auth()->user()->id],['deleted_at','=',null]])
            ->orderBy('specification_id')
            ->get();
        return view('teachers.courses.index',compact('courses'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specifications = Specification::all();
        return view('teachers.courses.create',compact('specifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|max:225|string',
            'specification_id'=>'required',
            'specName'=>'bail|required_if:specification_id,==,"other"',
            'content'=>'required',
            'duration'=>'required|max:5'
        ]);



        $input = $request->all();


        if($input['specification_id'] != "other")
        {
            Course::create([
                'name'=>$input['name'],
                'user_id'=>auth()->user()->id,
                'specification_id'=>$input['specification_id'],
                'duration'=>$input['duration'],
                'content'=>$input['content']
            ]);

        }
        else
        {
            $lastId = Specification::create(['name'=>$input['specName']])->id;
            Course::create([
                'name'=>$input['name'],
                'user_id'=>auth()->user()->id,
                'specification_id'=>$lastId,
                'duration'=>$input['duration'],
                'content'=>$input['content']
            ]);
        }

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $students = $course->students()->wherePivot('course_id',$course->id)
            ->wherePivot('feedBack','<>',null)->get();

        $feedback = $course->students()
            ->wherePivot('user_id',auth()->user()->id)
            ->wherePivot('course_id',$course->id)
            ->get();

        return view('teachers.courses.show',compact('course' , 'students','feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        $specifications = Specification::all();
        return view('teachers.courses.edit',compact('course','specifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $v = $request->validate([
            'name'=>'required|max:225|string',
            'specification_id'=>'required',
            'specName'=>'bail|required_if:keyQ,==,1|unique:specifications,name',
            'content'=>'required',
            'duration'=>'required|max:5'
        ]);

        if($request->input('quantifier') == 1)
        {

            $lastId= Specification::create(['name'=>$request->input('specName')])->id;
            $course->update([
                'name'=>$request->input('name'),
                'specification_id'=>$lastId,
                'content'=> $request->input('content'),
                'duration'=>$request->input('duration'),
            ]);
        }
        elseif($request->input('quantifier') == 0)
        {
            $course->update([
                'name'=>$request->input('name'),
                'specification_id'=>$request->input('specification_id'),
                'content'=> $request->input('content'),
                'duration'=>$request->input('duration'),
            ]);
        }


        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

    }
}
