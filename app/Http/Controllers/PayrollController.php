<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Calculate payroll data for AJAX (unit, rate, total, gross_pay)
     */
    public function calculate(Request $request)
    {
        $employeeId = $request->query('employee_id');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        
        $employee = \App\Models\Employee::find($employeeId);
        if (!$employee || !$startDate || !$endDate) {
            return response()->json([
                'unit' => '',
                'rate' => '',
                'total' => '',
                'gross_pay' => '',
            ]);
        }
        
        $attendances = \App\Models\Attendance::where('employee_id', $employeeId)
            ->whereDate('attended_at', '>=', $startDate)
            ->whereDate('attended_at', '<=', $endDate)
            ->get();

        $totalMinutes = 0;
        foreach ($attendances as $attendance) {
            if ($attendance->total_hours) {
                [$h, $m] = explode(':', $attendance->total_hours);
                $totalMinutes += ((int)$h) * 60 + ((int)$m);
            }
        }
    
        $unit = number_format($totalMinutes / 60, 2); 
        $decimalHours = $totalMinutes / 60;
        $rate = $employee->salary ?? 0;
        $total = round($decimalHours * $rate, 2);
        $gross_pay = $total;

        return response()->json([
            'unit' => $unit,
            'rate' => number_format($rate, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
            'gross_pay' => number_format($gross_pay, 2, '.', ''),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = \App\Models\Employee::all();
        $query = Payroll::with(['employee']);
        
        if (request('employee')) {
            $query->where('employee_id', request('employee'));
        }
        
        $payrolls = $query->orderBy('pay_date', 'desc')->get();
        return view('payroll.show', compact('employees', 'payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = \App\Models\Employee::all();
        return view('payroll.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'pay_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'deductions' => 'nullable|array',
            'deductions.*.name' => 'required_with:deductions|string|max:255',
            'deductions.*.amount' => 'required_with:deductions|numeric|min:0',
        ]);

        $employee = \App\Models\Employee::find($validated['employee_id']);
        $attendances = \App\Models\Attendance::where('employee_id', $validated['employee_id'])
            ->whereDate('attended_at', '>=', $validated['start_date'])
            ->whereDate('attended_at', '<=', $validated['end_date'])
            ->get();

        $totalMinutes = 0;
        foreach ($attendances as $attendance) {
            if ($attendance->total_hours) {
                [$h, $m] = explode(':', $attendance->total_hours);
                $totalMinutes += ((int)$h) * 60 + ((int)$m);
            }
        }
        $unit = number_format($totalMinutes / 60, 2); 
        $decimalHours = $totalMinutes / 60;
        $rate = $employee->salary ?? 0;
        $total = round($decimalHours * $rate, 2);

        $totalDeductions = 0;
        if (isset($validated['deductions'])) {
            foreach ($validated['deductions'] as $deduction) {
                $totalDeductions += $deduction['amount'];
            }
        }

        $grossPay = $total - $totalDeductions;

        $payroll = Payroll::create([
            'employee_id' => $validated['employee_id'],
            'pay_date' => $validated['pay_date'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_hours' => $unit,
            'deductions' => (float) $totalDeductions, // Ensure numeric value is stored
            'gross_pay' => $grossPay,
        ]);

        return redirect()->route('payroll.index')->with('success', 'Payroll created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        $payroll->load(['employee', 'deductions']);
        return view('payroll.detail', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        $employees = \App\Models\Employee::all();
        $payroll->load('deductions');
        return view('payroll.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'pay_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'deductions' => 'nullable|array',
            'deductions.*.name' => 'required_with:deductions|string|max:255',
            'deductions.*.amount' => 'required_with:deductions|numeric|min:0',
        ]);

        $employee = \App\Models\Employee::find($validated['employee_id']);
        $attendances = \App\Models\Attendance::where('employee_id', $validated['employee_id'])
            ->whereDate('attended_at', '>=', $validated['start_date'])
            ->whereDate('attended_at', '<=', $validated['end_date'])
            ->get();

        $totalMinutes = 0;
        foreach ($attendances as $attendance) {
            if ($attendance->total_hours) {
                [$h, $m] = explode(':', $attendance->total_hours);
                $totalMinutes += ((int)$h) * 60 + ((int)$m);
            }
        }

        $unit = number_format($totalMinutes / 60, 2); 
        $decimalHours = $totalMinutes / 60;
        $rate = $employee->salary ?? 0;
        $total = round($decimalHours * $rate, 2);

        $totalDeductions = 0;
        if (isset($validated['deductions'])) {
            foreach ($validated['deductions'] as $deduction) {
                $totalDeductions += $deduction['amount'];
            }
        }

        $grossPay = $total - $totalDeductions;

        $payroll->update([
            'employee_id' => $validated['employee_id'],
            'pay_date' => $validated['pay_date'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_hours' => $unit,
            'deductions' => $totalDeductions,
            'gross_pay' => $grossPay,
        ]);

        $payroll->deductions()->delete();

        if (isset($validated['deductions'])) {
            foreach ($validated['deductions'] as $deduction) {
                Payroll::create([
                    'payroll_id' => $payroll->id,
                    'name' => $deduction['name'],
                    'amount' => $deduction['amount'],
                ]);
            }
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->deductions()->delete();
        $payroll->delete();
        return redirect()->route('payroll.index')->with('success', 'Payroll deleted successfully.');
    }
}