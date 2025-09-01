<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.show', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create($request->only('name'));

        return redirect()->route('departments.index')->with('success', 'Department created.');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $departments = new Department;
        $departments->name = $request->name;
        $departments->save();

        return redirect('/departments')->with('success', 'Department added successfully!');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::find($id);
        $department->name = $request->name;
        $department->save();


        return redirect('/departments')->with('success', 'Employee updated successfully!');
    }


    public function destroy(Department $department, $id)
    {
        $department = Department::find($id);
        $department->delete();

        return redirect('/departments')->with('success', 'Department deleted.');
    }
}