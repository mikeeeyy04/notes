@extends('departments.app')

@section('content')
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                        <h2>Departments</h2>
                    </a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark"><i
                            class='bi bi-plus-lg me-2'></i>Add Department</button>
                </div>
            </header>

            @if ($departments->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Department Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $index => $department)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $department->name ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#viewDepartment{{ $department->id }}">
                                            <i class="bi bi-eye me-1"></i> View Department
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning">No departments found.</div>
            @endif



            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025
            </footer>
        </div>
    </main>
@endsection
