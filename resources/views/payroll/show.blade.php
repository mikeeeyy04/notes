@extends('payroll.app')

@section('content')
    <main>
        <div class="container py-4">
            <!-- Header -->
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                        <h2 class="ms-2">Payrolls</h2>
                    </a>
                    <div class="d-flex align-items-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addPayroll" class="btn btn-dark">
                            <i class='bi bi-plus-lg me-2'></i>Add New Payroll
                        </button>
                    </div>
                </div>
            </header>

            <x-input-success :message="session('success')" />


            <!-- Statistics Overview -->
            <div class="p-5 mb-4 stats-card rounded-3">
                <div class="container-fluid py-2">
                    <h1 class="display-5 fw-bold">Payroll Logs</h1>
                    <p class="col-md-8 fs-4 text-white-50">Manage your organization's payroll effectively.</p>
                </div>
            </div>

            <div class="bg-white border rounded-3 shadow-sm">
                <div class="p-4">
                    <h4 class="fw-bold mb-3">
                        <i class="bi bi-table me-2"></i>Payroll Directory
                    </h4>
                    {{-- <div class="mb-3">
                            <a href="{{ route('payroll.export.csv') }}" class="btn btn-outline-dark btn-sm me-1">
                                <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
                            </a>
                            <a href="{{ route('payroll.export.excel') }}" class="btn btn-outline-dark btn-sm me-1">
                                <i class="bi bi-file-earmark-excel"></i> Export Excel
                            </a>
                            <a href="{{ route('payroll.export.pdf') }}" class="btn btn-outline-dark btn-sm me-1">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF
                            </a>
                            <a href="{{ route('payroll.print') }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                <i class="bi bi-printer"></i> Print
                            </a>
                        </div> --}}
                    <form method="GET" action="{{ route('payroll.index') }}" class="mb-4 flex flex-wrap gap-2">
                        <label for="employee" class="font-semibold">Filter by Employee:</label>
                        <select name="employee" id="employee" class="border rounded px-2 py-1"
                            onchange="this.form.submit()">
                            <option value="">All Employees</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ request('employee') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->firstName }} {{ $employee->middleName }} {{ $employee->lastName }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Employee</th>
                                    <th>Pay Date</th>
                                    <th>Period</th>
                                    <th>Total Hours</th>
                                    <th>Deductions</th>
                                    <th>Gross Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payrolls as $payroll)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $payroll->employee->firstName }}
                                            {{ $payroll->employee->middleName }} {{ $payroll->employee->lastName }}</td>
                                        <td class="px-4 py-2 border">
                                            {{ \Carbon\Carbon::parse($payroll->pay_date)->format('M d, Y') }}</td>
                                        <td class="px-4 py-2 border">
                                            {{ \Carbon\Carbon::parse($payroll->start_date)->format('M d, Y') }} -
                                            {{ \Carbon\Carbon::parse($payroll->end_date)->format('M d, Y') }}</td>
                                        <td class="px-4 py-2 border">{{ $payroll->total_hours }}</td>
                                        <td class="px-4 py-2 border">₱{{ number_format($payroll->deductions, 2) }}</td>
                                        <td class="px-4 py-2 border">₱{{ number_format($payroll->gross_pay, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">No payroll records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- <div class="d-flex justify-content-center mt-4">
                    {{ $employees->links() }}
                </div> --}}

            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025 Employee Management System
            </footer>
        </div>
    </main>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable({
                lengthChange: true,
                pageLength: 10,
                ordering: true,
                order: [
                    [1, 'asc']
                ],
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                }]
            });
        });
    </script>
@endsection
