@extends('employees.app')

@section('content')
    <main>
        <div class="container py-4">
            <!-- Header -->
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                        <h2 class="ms-2">Employees</h2>
                    </a>
                    <div class="d-flex align-items-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark">
                            <i class='bi bi-plus-lg me-2'></i>Add Employee
                        </button>
                    </div>
                </div>
            </header>

            <x-input-success :message="session('success')" />


            @if ($employees->count())
                <!-- Statistics Overview -->
                <div class="p-5 mb-4 stats-card rounded-3">
                    <div class="container-fluid py-2">
                        <h1 class="display-5 fw-bold">Employee Overview</h1>
                        <p class="col-md-8 fs-4 text-white-50">Manage your organization's workforce effectively.</p>
                    </div>
                </div>

                <!-- Employees Table -->
                <div class="bg-white border rounded-3 shadow-sm">
                    <div class="p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-table me-2"></i>Employee Directory
                        </h4>
                        <div class="table-responsive">
                            <table id="employeesTable" class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Full Name</th>
                                        <th>Department</th>
                                        <th>Age</th>
                                        <th>Birthday</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td class="text-center" style="width: 100px;">
                                                @if (!$employee->image)
                                                    <img src="img/default-avatar.jpg" class="rounded-circle mx-auto d-block employee-avatar"
                                                        alt="Avatar" />
                                                @else
                                                    <img src="{{ Storage::url($employee->image) }}" class="rounded-circle mx-auto d-block employee-avatar"
                                                        alt="Avatar" />
                                                @endif
                                            </td>
                                            <td class="fw-semibold">
                                                {{ trim(($employee->firstName ?? '') . ' ' . ($employee->middleName ?? '') . ' ' . ($employee->lastName ?? '')) }}
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $employee->department->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $employee->age ?? 'N/A' }}</td>
                                            <td>{{ $employee->birthday ? \Carbon\Carbon::parse($employee->birthday)->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-dark btn-action" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#viewEmployee{{ $employee->id }}">
                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $employees->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-people display-1 text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">No employees found</h3>
                    <p class="text-muted mb-4">Start building your team by adding your first employee.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark btn-lg">
                        <i class='bi bi-plus-lg me-2'></i>Add Your First Employee
                    </button>
                </div>
            @endif

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
        $('#employeesTable').DataTable({
            lengthChange: true,
            pageLength: 10,
            ordering: true,
            order: [
                [1, 'asc']
            ],
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columnDefs: [{
                orderable: false,
                targets: [0, 5]
            }]
        });
    </script>
@endsection
