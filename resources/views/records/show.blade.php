@extends('records.app')

@section('content')
    <main>
        <div class="container py-4">
            <!-- Header -->
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                        </svg>
                        <h2 class="ms-2">Attendance Records</h2>
                    </a>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-dark">
                            <i class="bi bi-arrow-clockwise me-2"></i>Refresh
                        </button>
                    </div>
                </div>
            </header>

            <x-input-success :message="session('success')" />

            @if ($records->count())
                <!-- Statistics Overview -->
                <div class="p-5 mb-4 stats-card rounded-3">
                    <div class="container-fluid py-2">
                        <h1 class="display-5 fw-bold">Attendance Overview</h1>
                        <p class="col-md-8 fs-4 text-white-50">Track and monitor employee attendance in real-time.</p>
                    </div>
                </div>

                <!-- Attendance Records Table -->
                <div class="bg-white border rounded-3 shadow-sm">
                    <div class="p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-table me-2"></i>Attendance Records
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Time In</th>
                                        <th scope="col">Time Out</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $index => $record)
                                        <tr>
                                            <td class="fw-semibold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 2.5rem; height: 2.5rem;">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ trim(($record->employee->firstName ?? '') . ' ' . ($record->employee->middleName ?? '') . ' ' . ($record->employee->lastName ?? '')) }}</div>
                                                        <small class="text-muted">ID: {{ $record->employee_id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $record->employee->department->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-box-arrow-in-right text-success me-2"></i>
                                                    <span class="fw-semibold">{{ $record->attended_at ? \Carbon\Carbon::parse($record->attended_at)->format('h:i A') : 'N/A' }}</span>
                                                </div>
                                                @if($record->attended_at)
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($record->attended_at)->format('M d, Y') }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($record->checked_out_at)
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-box-arrow-left text-danger me-2"></i>
                                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($record->checked_out_at)->format('h:i A') }}</span>
                                                    </div>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($record->checked_out_at)->format('M d, Y') }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($record->checked_out_at)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Completed
                                                    </span>
                                                @else
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-clock me-1"></i>Present
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-calendar-x display-1 text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">No attendance records found</h3>
                    <p class="text-muted mb-4">Attendance records will appear here once employees start checking in.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-dark">
                            <i class="bi bi-arrow-clockwise me-2"></i>Refresh Records
                        </button>
                        <a href="/attendance" class="btn btn-outline-dark">
                            <i class="bi bi-clock-history me-2"></i>View Attendance
                        </a>
                    </div>
                </div>
            @endif




            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025 Attendance Management System
            </footer>
        </div>
    </main>
@endsection
