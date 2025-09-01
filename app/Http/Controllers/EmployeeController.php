<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('department')->paginate(10);
        $departments = Department::all();
        

        return view('employees.show', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:255',
            'middleName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'age' => 'required|integer',
            'department_id' => 'required|max:255',
            'birthday' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profileImage = null;

        if ($image = $request->file('image')) {
           $destinationPath = storage_path('app/public/img');
            $profileImage = "img/" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

        $employee = new Employee;
        $employee->firstName = $request->firstName;
        $employee->middleName = $request->middleName;
        $employee->lastName = $request->lastName;
        $employee->age = $request->age;
        $employee->birthday = $request->birthday;
        $employee->department_id = $request->department_id;
        $employee->image = $profileImage;
        $employee->user_id = auth()->id();
        $employee->datecreated = now();
        $employee->save();

        return redirect('/employees')->with('success', 'Employee added successfully!');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = Department::all();
        return view('employees.view', compact('employees', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'firstName' => 'required|max:255',
            'middleName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'age' => 'required|integer',
            'department_id' => 'required|max:255',
            'birthday' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = storage_path('app/public/img');
            $profileImage = "img/" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }


        $employees = Employee::find($request->id);
        $employees->firstName = $request->firstName;
        $employees->middleName = $request->middleName;
        $employees->lastName = $request->lastName;
        $employees->age = $request->age;
        $employees->department_id = $request->department_id;
        $employees->birthday = $request->birthday;
        $employees->image = $profileImage ?? $employees->image;
        $employees->save();


        return redirect('/employees')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::find($id);
        $employees->delete();

        return redirect('/employees')->with('success', 'Employee deleted successfully!');
    }
}
