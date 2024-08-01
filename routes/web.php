<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//joins
Route::get('students', [StudentController::class, 'index']);
Route::get('inner-join', [StudentController::class, 'innerJoin']);
Route::get('left-join', [StudentController::class, 'leftJoin']);
Route::get('right-join', [StudentController::class, 'rightJoin']);
Route::get('join', [StudentController::class, 'join']);
Route::get('join-left', [StudentController::class, 'joinLeft']);
Route::get('join-right', [StudentController::class, 'joinRight']);





//queries
Route::get('with-name', [StudentController::class, 'findWithName']);
Route::get('only-email', [StudentController::class, 'getEmailAndName']);
Route::get('by-id', [StudentController::class, 'getById']);
Route::get('get-pluck', [StudentController::class, 'getPlucked']);
Route::get('get-count', [StudentController::class, 'getStudentsCount']);
Route::get('if-exists', [StudentController::class, 'ifExists']);
Route::get('if-not-exists', [StudentController::class, 'ifNotExists']);

#select-statementss
Route::get('select-student', [StudentController::class, 'selectStudent']);
Route::get('distinct-student', [StudentController::class, 'distinctResults']);
Route::get('add-column', [StudentController::class, 'alreadyExistingData']);
Route::get('students-avg-age', [StudentController::class, 'studentsAvgAge']);


#raw statements
Route::get('raw-index', [StudentController::class, 'rawIndex']);
Route::get('having-raw', [StudentController::class, 'havingRaw']);
