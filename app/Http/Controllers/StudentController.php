<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index',compact('students'))->with('j', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        //dd($request->input());die;
        $request->validate([
            'name' => 'required|',
            'detail' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $fileName = time().'.'.$request->file->extension();  
        //print_r(public_path('uploads'));die;
        $request->file->move(public_path('uploads'), $fileName);
        $student = new Student();
        $student->name = $request->input('name');
        $student->detail = $request->input('detail');
        $student->file = $fileName;
        $student->save();
        //Student::create($request->all());

        //Mail::to('email1@email.com')->send(new WelcomeMail);
        return redirect()->route('students.index')->with('success','Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show',compact('student'));
    }


    public function edit(Student $student)
    {
        return view('students.edit',compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success','Student updated successfully.');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully.');
    }
}