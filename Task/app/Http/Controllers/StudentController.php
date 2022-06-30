<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class StudentController extends Controller
{
    function studentView()
    {
        $students = student::all();
        return view("student", compact('students'));
    }


    function studentAdd(Request $request)
    {

        $request->validate([
            'fullName' => 'required',
            'nameWithInitial' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'registeredDate' => 'required',
        ]);

        $image_name ="";
        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png',
            ]);

            $image = $request->file('photo');
            $image_name =  time() . '.' . $image->extension();
            $image->move("student", $image_name);
        }

        // for add Function-------------------------------------
        if (!($request->id)) {



            $student = new student();
            $student->fullName = $request->fullName;
            $student->nameWithInitial = $request->nameWithInitial;
            $student->address = $request->address;
            $student->dob = $request->dob;
            $student->gender = $request->gender;
            $student->photo = $image_name;
            $student->registeredDate = $request->registeredDate;

            try {
                $student->save();
                return redirect('/')->with('sucess', 'Successfully Recordered');
            } catch (\Throwable $th) {
                return redirect('/')->with('error', 'Something Wrong');
            }
        }

        // for update function-----------------------------------
        else {

            $student = student::find($request->id);
            $student->fullName = $request->fullName;
            $student->nameWithInitial = $request->nameWithInitial;
            $student->address = $request->address;
            $student->dob = $request->dob;
            $student->gender = $request->gender;

            if ($request->hasFile('photo')) {
                $image_name = $image_name;
            } else {
                $image_name = $student->photo;
            }

            $student->photo = $image_name;
            $student->registeredDate = $request->registeredDate;

            try {
                $student->save();
                return redirect('/')->with('sucess', 'Successfully Updated');
            } catch (\Throwable $th) {
                return redirect('/')->with('error', 'Something Wrong');
            }
        }
    }


    function studentDelete($id)
    {
        $student = student::find($id);
        $student->delete();
        return redirect('/')->with('sucess', 'Successfully Deleted');
    }

    function studentEdit($id)
    {
        $student = student::find($id);
        return  $student;
    }
}
