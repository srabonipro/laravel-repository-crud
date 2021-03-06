<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentInterface;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        $students = $this->student->all();
        return view('student.index', compact('students'));
    }


    public function create()
    {
        return view('student.create');
    }


    public function store(StudentRequest $request)
    {
        $this->student->store($request->validated());
        session()->flash('message', 'Student Created');
        return back();
    }


    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }


    public function update(StudentRequest $request,Student $student)
    {
        $this->student->update($request->validated(), $student);
        session()->flash('message', 'Student Updated...');
        return redirect()->route('student.index');
    }


    public function destroy(Student $student)
    {
        $this->student->delete($student);
        session()->flash('message', 'Student Deleted...');
        return back();
    }
}
