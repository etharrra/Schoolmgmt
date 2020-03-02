<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mark;
use App\Student;
use App\Subject;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mark = Mark::all();
        return view('backend.mark.index',compact('mark'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('backend.mark.create',compact('students','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // Validation
        $request->validate([
            "mark" => 'required|min:1|max:191',
            "student_id" => 'required',
            "subject_id" => 'required',
            "month" => 'required'
        ]);

        $mark = new Mark;
        $mark->mark = request('mark');
        $mark->student_id = request('student_id');
        $mark->subject_id = request('subject_id');
        $mark->month = request('month');
        $mark->save();

        return redirect()->route('mark.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $mark = Mark::find($id);
        return view('backend.mark.edit',compact('students','subjects','mark'));
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
        //dd($request);
        // Validation
        $request->validate([
            "mark" => 'required|min:1|max:191',
            "student_id" => 'required',
            "subject_id" => 'required',
            "month" => 'required'
        ]);

        $mark = Mark::find($id);
        $mark->mark = request('mark');
        $mark->student_id = request('student_id');
        $mark->subject_id = request('subject_id');
        $mark->month = request('month');
        $mark->save();
         // Redirect
        return redirect()->route('mark.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mark = Mark::find($id);
        $mark->delete();

        return redirect()->route('mark.index');
    }
}
