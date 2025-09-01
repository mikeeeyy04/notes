<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Department;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $notesCount = Note::count();
        $employeesCount = Employee::count();
        $departmentsCount = Department::count();

        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();

        $thisWeekCount = Note::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $employeeThisWeekCount = Employee::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

        $departmentData = Department::withCount('employees')->get();
        $departmentLabels = $departmentData->pluck('name');
        $departmentCounts = $departmentData->pluck('employees_count');

        // Days: Mon–Sun (MySQL: 1=Sunday ... 7=Saturday)
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        // Notes per day
        $weeklyNotes = Note::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        // Employees added per day
        $weeklyEmployees = Employee::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        // Map to Mon–Sun (MySQL: 2=Mon, ..., 1=Sun)
        $notesData = [];
        $employeeData = [];
        foreach ([2, 3, 4, 5, 6, 7, 1] as $dayOfWeek) {
            $notesData[] = $weeklyNotes[$dayOfWeek] ?? 0;
            $employeeData[] = $weeklyEmployees[$dayOfWeek] ?? 0;
        }

        return view('dashboard', compact(
            'notesCount',
            'employeesCount',
            'departmentsCount',
            'thisWeekCount',
            'employeeThisWeekCount',
            'departmentLabels',
            'departmentCounts',
            'notesData',
            'employeeData',
            'days'
        ));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
