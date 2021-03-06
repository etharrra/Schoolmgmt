<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Grade;


class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('backend.subject.index',compact('subjects','grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view('backend.subject.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
         // dd($request);

        //validation

        $request->validate([
            "subject" => 'required|min:3|max:191',
            "grades" => 'required'
        ]);
        //dd($request);

        //Upload if exist

        //Store Data
        $subject = new Subject;
        $subject->name = request('subject');
        $subject->save();

        //add_student_subject
        $subject->grades()->attach(request('grades'));

         return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        return view('backend.subject.show',compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grades = Grade::all();
        $subject = Subject::find($id);
        return view('backend.subject.edit',compact('grades','subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            "subject" => 'required|min:3|max:191',
            "grades" => 'required'
        ]);
        //dd($request);

        //Upload if exist

        //Store Data
        $subject = Subject::find($id);
        $subject->name = request('subject');
        $subject->save();

        $subject->grades()->detach();
        $subject->grades()->attach(request('grades'));

         return redirect()->route('subject.index');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->route('subject.index');
    }
}
