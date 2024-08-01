<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
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

    public function findWithName()
    {
        $student = DB::table('students')->where('name', '=', 'Prof. Pasquale Koepp')->get();
        dd($student);
    }

    public function getEmailAndName()
    {
        $student = DB::table('students')->where('name', '=', 'Prof. Pasquale Koepp')->get(['name', 'email']);
        dd($student);
    }

    public function getById()
    {
        $student = DB::table('students')->find(4);
        dd($student);
    }

    //წამოიღბს სტუდენტის თეიბლიდან ყველა სახელს.
    public function getPlucked()
    {
        $student = DB::table('students')->pluck('name');
        dd($student);
    }

    public function getStudentsCount()
    {
        $count = DB::table('students')->count();

        dd($count);
    }

    //ასე შეგვიძლია გავიგოთ არსებობს თუ არა ეს იუზერი საბჯექთ თეიბლში.
    public function ifExists()
    {
        $student = null;
        if (DB::table('subjects')->where('student_id', '=', '3')->exists()) {
            $student = true;
            dd($student);
        }
        dd(false);
    }

    //ასე შეგვიძლია გავიგოთ არსებობს თუ არა ეს იუზერი საბჯექთ თეიბლში.
    public function ifNotExists()
    {
        $student = null;
        if (DB::table('subjects')->where('student_id', '=', '3')->doesntExist()) {
            $student = true;
            dd($student);
        }
        dd(false);
    }

    # Select Statements

    public function selectStudent()
    {
        $student = DB::table('students')->select('name as student_name', 'email as student_email')->get();
        dd($student);
    }


    public function distinctResults()
    {
        // distinct იღებს ყველა დუპლიკატს.
        $students = DB::table('students')
            ->where('age', '>', 30)
            ->distinct()
            ->get();

        $withoudDisctinct = DB::table('students')->where('age', '>', 30)->get();

        dd($students, $withoudDisctinct);
    }

    public function alreadyExistingData()
    {
        // addSelect() ამატებს უკვე არსებულ ქვერის დამატებიტ ველს.
        $query = DB::table('students')->select('name');

        $addColumn = $query->addSelect('age')->get();

        dd($query, $addColumn);
    }


    #Raw Expressions
    public function rawIndex()
    {
        $students = DB::table('students')
            ->select(DB::raw('count(*) as user_count ,status'))->where('status', '=', '0')
            ->groupBy('status')
            ->get();
        dd($students);
    }

    public function havingRaw()
    {
        $students = DB::table('students')
            ->select('name', 'status', DB::raw('SUM(age) as age_sum'))
            ->groupBy('status')
            ->havingRaw('SUM(age) > ?', [30])
            ->get();

        dd($students);
    }

    public function studentsAvgAge()
    {
        $students = DB::table('students')
            ->select('age')
            ->avg('age');
        dd($students);
    }



    public function join()
    {
        $students = DB::table('students')
            ->join('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();
        dd($students);
    }

    public function joinLeft()
    {
        $students = DB::table('students')
            ->leftJoin('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();

        dd($students);
    }


    public function joinRight()
    {
        $students = DB::table('students')
            ->rightJoin('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();

        dd($students);
    }

    #relations
    //წამოიღებს მხოლოდ არსებულ ველებს. თუ რომელიმე ნალია არ მოგვაწვდის ინფორმაციას.
    public function innerJoin()
    {
        $students = DB::table('students')
            ->join('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();

        dd($students);
    }

    //წამოიღბს პირველი თეიბლიდან ყველაფერს თუმცა მეორე თეიბლში თუ რომელიმე ნალია მოგვაწვდის ნალს.
    public function leftJoin()
    {
        $students = DB::table('students')
            ->leftJoin('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();

        dd($students);
    }

    //წამოიღბს მოერე თეიბლიდან ყველაფერს თუმცა პირველ თეიბლში თუ რომელიმე ნალია მოგვაწვდის ნალს.
    public function rightJoin()
    {
        $students = DB::table('students')
            ->rightJoin('subjects', 'students.id', '=', 'subjects.student_id')
            ->select('students.name as student_name', 'subjects.name as subject_name')
            ->get();

        dd($students);
    }
}
