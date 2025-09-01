@extends('departments.app')

@section('content')
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-building-fill" viewBox="0 0 16 16">
                            <path
                                d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                        </svg>
                        <h2>Departments</h2>
                    </a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark"><i
                            class='bi bi-plus-lg me-2'></i>Add Department</button>
                </div>
            </header>

            <x-input-success :message="session('success')" />

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
                                        <button class="btn btn-sm btn-dark" type="button" data-bs-toggle="modal"
                                            data-bs-target="#viewDepartment{{ $department->id }}">
                                            <i class="bi bi-pencil me-1"></i> Edit Department
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
