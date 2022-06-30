<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class ReportController extends Controller
{
    function getDatas(Request $request){

        $students = student::select('students.*');

        if ($request->studentNo) {
            $students =  $students->where('students.id', $request->studentNo);
        }

        if ($request->from) {
            $students =  $students->where('students.registeredDate', '>=', $request->from);
        }

        if ($request->to) {
            $students =  $students->where('students.registeredDate', '<=', $request->to);
        }

        if ($request->gender) {
            $students =  $students->where('students.gender', $request->gender);
        }
        $students =  $students->get();

        return view('/report', compact('students'));
    }
}
