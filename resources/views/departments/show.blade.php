@extends('departments.app')

@section('content')
    <main>
        <div class="container py-4">
            <!-- Header -->
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-building-fill" viewBox="0 0 16 16">
                            <path
                                d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                        </svg>
                        <h2 class="ms-2">Departments</h2>
                    </a>
                    <div class="d-flex align-items-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark">
                            <i class='bi bi-plus-lg me-2'></i>Add Department
                        </button>
                    </div>
                </div>
            </header>

            <x-input-success :message="session('success')" />

            @if ($departments->count())
                <!-- Statistics Overview -->
                <div class="p-5 mb-4 stats-card rounded-3">
                    <div class="container-fluid py-2">
                        <h1 class="display-5 fw-bold">Department Overview</h1>
                        <p class="col-md-8 fs-4 text-white-50">Organize and manage your company's departments effectively.</p>
                    </div>
                </div>

                <!-- Departments Grid -->
                <div class="row align-items-md-stretch mb-4">
                    @foreach ($departments as $index => $department)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 department-card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="department-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-building-fill"></i>
                                        </div>
                                        <span class="badge bg-secondary">{{ $department->employees->count() }} employees</span>
                                    </div>
                                    <h5 class="card-title fw-bold mb-2">{{ $department->name ?? 'N/A' }}</h5>
                                    <p class="card-text text-muted mb-3">
                                        @if ($department->employees->count() > 0)
                                            Active department with {{ $department->employees->count() }} team members.
                                        @else
                                            New department - ready for team members.
                                        @endif
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn btn-dark btn-action" type="button" data-bs-toggle="modal"
                                            data-bs-target="#viewDepartment{{ $department->id }}">
                                            <i class="bi bi-eye me-2"></i>View Details
                                        </button>
                                        <small class="text-muted">Dept. #{{ $index + 1 }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-building display-1 text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">No departments found</h3>
                    <p class="text-muted mb-4">Start organizing your company by creating your first department.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark btn-lg">
                        <i class='bi bi-plus-lg me-2'></i>Create Your First Department
                    </button>
                </div>
            @endif



            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025 Department Management System
            </footer>
        </div>
    </main>
@endsection
