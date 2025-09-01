<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        $today = now()->toDateString();
        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('attended_at', $today)
            ->first();

        if ($attendance) {
            if (is_null($attendance->checked_out_at)) {
                $attendance->update([
                    'checked_out_at' => now()
                ]);

                return response()->json([
                    'message' => 'Checked out successfully',
                    'employee' => [
                        'full_name' => $employee->firstName . ' ' . $employee->middleName . ' ' . $employee->lastName,
                        'age' => \Carbon\Carbon::parse($employee->birthday)->age ?? 'N/A',
                        'image' => asset('storage/' . $employee->image),
                        'department' => $employee->department->name,
                        'checked_out_at' => now()->format('Y-m-d h:i:s A'),
                    ]
                ]);
            }

            return response()->json([
                'message' => 'Already checked out today.',
                'status' => 'info'
            ]);
        }

        $attendance = Attendance::create([
            'employee_id' => $employee->id,
            'attended_at' => now(),
        ]);

        return response()->json([
            'message' => 'Checked in successfully',
            'employee' => [
                'full_name' => $employee->firstName . ' ' . $employee->middleName . ' ' . $employee->lastName,
                'age' => \Carbon\Carbon::parse($employee->birthday)->age ?? 'N/A',
                'image' => asset('storage/' . $employee->image),
                'department' => $employee->department->name,
                'attended_at' => now()->format('Y-m-d h:i:s A'),
            ]
        ]);
    }
}
