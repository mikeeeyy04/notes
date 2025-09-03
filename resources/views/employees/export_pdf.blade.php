<!DOCTYPE html>
<html>

<head>
    <title>Employee List (PDF Export)</title>
    <style>
        body,
        table,
        th,
        td {
            font-family: Poppins, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 13px;
        }

        th {
            background: #212529;
            color: #fff;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #dee2e6;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.6em;
            font-size: 75%;
            font-weight: 700;
            color: #fff;
            background-color: #6c757d;
            border-radius: 0.25rem;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <h2>Employee Directory (PDF Export)</h2>
    <table>
        <thead>
            <tr>
                <th class="text-center">Avatar</th>
                <th>Full Name</th>
                <th>Salary</th>
                <th>Age</th>
                <th>Birthday</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td class="text-center">
                        @if (!$employee->image)
                            <img src="{{ storage_path('img/default-avatar.jpg') }}" class="avatar" alt="Avatar" />
                        @else
                            <img src="{{ storage_path('app/public/' . $employee->image) }}" class="avatar"
                                alt="Avatar" />
                        @endif
                    </td>
                    <td class="fw-semibold">
                        {{ trim(($employee->firstName ?? '') . ' ' . ($employee->middleName ?? '') . ' ' . ($employee->lastName ?? '')) }}
                    </td>
                    <td class="font-family: DejaVu Sans, sans-serif;">₱ {{ $employee->salary ?? '00' }}.00 per hour</td>
                    <td>{{ $employee->age ?? 'N/A' }}</td>
                    <td>{{ $employee->birthday ? \Carbon\Carbon::parse($employee->birthday)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td>
                        <span class="badge">{{ $employee->department->name ?? 'N/A' }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
