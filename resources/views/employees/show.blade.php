@extends('employees.app')

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
                        <h2>Employees</h2>
                    </a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-dark"><i
                            class='bi bi-plus-lg me-2'></i>Add Employee</button>
                </div>
            </header>

            @if ($employees->count())
                @foreach ($employees as $employee)
                    <div class="p-3 mb-4 bg-light rounded-3 latest-note mb-3">
                        <div class="d-flex justify-content-center mb-3">

                            @if (!$employee->image)
                            <img src="img/default-avatar.jpg" class="rounded-circle me-3"
                                style="width: 200px; height: 200px; object-fit: cover;" alt="Avatar" />

                                @else
                                <img src="{{ Storage::url($employee->image) }}" class="rounded-circle me-3"
                                style="width: 200px; height: 200px; object-fit: cover;" alt="Avatar" />
                            @endif

                            

                            <div class="container-fluid py-1">
                                <h4 class="fw-bold">
                                    {{ ($employee->firstName ?? '') . ' ' . ($employee->middleName ?? '') . ' ' . ($employee->lastName ?? '') }}
                                    </h1>
                                    <p class="fw-bold">{{ $employee->department->name ?? 'N/A' }}</p>
                                    <p class="m-0">Age: {{ $employee->age ?? '' }}</p>
                                    <p class="">Birthday:
                                        {{ $employee->birthday ? \Carbon\Carbon::parse($employee->birthday)->format('F d, Y') : '' }}
                                    </p>
                                    <button class="btn text-white btn-lg bg-dark" type="button" data-bs-toggle="modal"
                                        data-bs-target="#viewEmployee{{ $employee->id }}"><i class="bi bi-eye me-2"></i>View
                                        Employee</button>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <li class="list-group-item">No employees found.</li>
            @endif


            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025
            </footer>
        </div>
    </main>
@endsection
