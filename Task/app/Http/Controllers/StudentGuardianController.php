<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\studentGuardian;
use App\Models\student;



class StudentGuardianController extends Controller
{
    function view()
    {
        $students = student::all();
        $studentGuardians = studentGuardian::join('students', 'students.id', '=', 'student_guardians.student_id')
            ->select('student_guardians.*', 'students.fullName')
            ->get();

        return view('guardian', compact('students', 'studentGuardians'));
    }

    function studentGuardianAdd(Request $request)
    {

        $request->validate([
            'student_id' =>'required',
            'name' =>'required',
            'contactNo' =>'required|numeric',
            'address' =>'required',
            'relation' =>'required',

        ]);

        if (!($request->id)) {
            $studentGuardian = new studentGuardian();
            $studentGuardian->student_id  = $request->student_id;
            $studentGuardian->giardianName  = $request->name;
            $studentGuardian->contactNo  = $request->contactNo;
            $studentGuardian->Address  = $request->address;
            $studentGuardian->relation  = $request->relation;

            try {
                $studentGuardian->save();
                return redirect('/view')->with('sucess','Successfully Recordered');
            } catch (\Throwable $th) {
                return redirect('/view')->with('error','Something Wrong');
            }

        }

        else{

            $studentGuardian = studentGuardian::find($request->id);
            $studentGuardian->student_id  = $request->student_id;
            $studentGuardian->giardianName  = $request->name;
            $studentGuardian->contactNo  = $request->contactNo;
            $studentGuardian->Address  = $request->address;
            $studentGuardian->relation  = $request->relation;
            try {
                $studentGuardian->save();
                return redirect('/view')->with('sucess','Successfully Updated');
            } catch (\Throwable $th) {
                return redirect('/view')->with('error','Something Wrong');
            }


        }
    }

    function studentGuardianEdit($id){
        $studentGuardian = studentGuardian::find($id);
        return  $studentGuardian ;
    }

    function guarianDelete($id){
        $studentGuardian = studentGuardian::find($id);
        $studentGuardian -> delete();
        return redirect('/view')->with('sucess','Successfully Deleted');
    }
}
