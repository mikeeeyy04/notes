@extends('employees.app')

@section('content')
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                        class="bi bi-building-fill" viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                    <h2 class="ms-2">Employees</h2>
                </a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark">
                    <i class='bi bi-plus-lg me-2'></i>Add Employee
                </button>
            </header>

            <x-input-success :message="session('success')" />


            @if ($employees->count())
                <table id="employeesTable" class="table table-striped table-bordered">
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
                                        <img src="img/default-avatar.jpg" class="rounded-circle mx-auto d-block"
                                            style="width: 60px; height: 60px; object-fit: cover;" alt="Avatar" />
                                    @else
                                        <img src="{{ Storage::url($employee->image) }}" class="rounded-circle mx-auto d-block"
                                            style="width: 60px; height: 60px; object-fit: cover;" alt="Avatar" />
                                    @endif
                                </td>
                                <td>{{ trim(($employee->firstName ?? '') . ' ' . ($employee->middleName ?? '') . ' ' . ($employee->lastName ?? '')) }}
                                </td>
                                <td>{{ $employee->department->name ?? 'N/A' }}</td>
                                <td>{{ $employee->age ?? '' }}</td>
                                <td>{{ $employee->birthday ? \Carbon\Carbon::parse($employee->birthday)->format('F d, Y') : '' }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="modal"
                                        data-bs-target="#viewEmployee{{ $employee->id }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $employees->links() }}
                </div>
            @else
                <li class="list-group-item">No employees found.</li>
            @endif

            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025
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
