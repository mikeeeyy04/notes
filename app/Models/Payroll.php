<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $casts = [
        'deductions' => 'float',
    ];
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'pay_date',
        'start_date',
        'end_date',
        'total_hours',
        'deductions',
        'gross_pay',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
