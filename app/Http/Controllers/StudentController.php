<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::select(Student::raw('count(*) as students_count,status'))
            ->groupBy('status')
            ->get();
        dd($students);
    }

    public function innerJoin()
    {
        $students = DB::table('students')->join('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();

        dd($students);
    }
}
