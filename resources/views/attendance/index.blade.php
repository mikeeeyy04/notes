<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .clock-container {
            background: #212529;
            color: white;
            border-radius: 20px;
            padding: 3.5rem 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
        }

        .digital-clock {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            font-family: 'Courier New', monospace;
            /* text-shadow: 0 0 20px rgba(255, 255, 255, 0.3); */
            margin-bottom: 0.5rem;
        }

        .date-display {
            font-size: 1.2rem;
            text-align: center;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .attendance-input {
            font-size: 1.3rem;
            padding: 1rem 1.5rem;
            border: 3px solid #dee2e6;
            border-radius: 15px;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 500;
        }

        .attendance-input:focus {
            border-color: #212529;
            box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.25);
            transform: scale(1.02);
        }

        .attendance-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .attendance-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .employee-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            animation: slideIn 0.5s ease;
        }

        .error-message {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(33, 37, 41, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(33, 37, 41, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(33, 37, 41, 0);
            }
        }

        .stats-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 1.2rem;
            /* text-align: center; */
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .status-indicator {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .status-online {
            background-color: #28a745;
        }

        .status-offline {
            background-color: #6c757d;
        }

        .left-panel {
            padding-right: 1rem;
        }

        .right-panel {
            padding-left: 1rem;
        }

        .activity-section {
            height: calc(100vh - 200px);
            min-height: 600px;
        }

        .activity-card {
            max-height: 100%;
            overflow: auto;
        }

        .activity-body {
            max-height: calc(100vh - 350px);
            overflow-y: auto;
        }

        @media (max-width: 991.98px) {
            .left-panel, .right-panel {
                padding-left: 0;
                padding-right: 0;
            }
            
            .activity-section {
                height: auto;
                min-height: auto;
            }
            
            .activity-body {
                max-height: 400px;
            }
        }
    </style>
</head>

<body>
    <main>
        <div class="container-fluid py-4">
            <!-- Header -->
            <header class="pb-3 px-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/dashboard" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-clock-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        </svg>
                        <h2 class="ms-2">Employee Attendance</h2>
                    </a>
                    <div class="d-flex align-items-center">
                        <span id="lastUpdate" class="text-muted small">Just now</span>
                    </div>
                </div>
            </header>

            <!-- Main Content Row -->
            <div class="row p-4">

                <div class="col-lg-6 left-panel">
                    <div class="clock-container">
                        <div class="digital-clock" id="digitalClock">00:00:00</div>
                        <div class="date-display" id="dateDisplay">Loading...</div>
                    </div>

                    <div class="card attendance-card mb-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="bi bi-person-badge fs-1 text-dark mb-3"></i>
                                <h3 class="fw-bold">Record Attendance</h3>
                                <p class="text-muted">Enter your Employee ID to time in/out</p>
                            </div>

                            <div class="mb-4 px-5">
                                <input type="text" id="employeeIdInput"
                                    class="form-control attendance-input pulse-animation"
                                    placeholder="Enter Employee ID" autofocus autocomplete="off" />
                                <div class="form-text text-center mt-3">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Press Enter to submit or scan your employee badge
                                </div>
                            </div>

                            {{-- <div class="text-center">
                                <span class="badge bg-dark me-2">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Secure Connection
                                </span>
                                <span class="badge bg-secondary">
                                    <i class="bi bi-cpu me-1"></i>
                                    Real-time Processing
                                </span>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Message Area -->
                    <div id="messageContainer"></div>
                </div>

                <!-- Right Panel: Recent Activity -->
                <div class="col-lg-6 right-panel">
                    <div class="activity-section">
                        <div class="card activity-card">
                            <div class="card-header bg-dark text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="bi bi-clock-history me-2"></i>
                                        Recent Activity
                                    </h5>
                                </div>
                            </div>
                            <div class="card-body p-3 activity-body">
                                <div class="row" id="recentActivity">
                                </div>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <small class="text-muted p-0">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Updates automatically every few seconds
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="pt-3 mt-4 text-muted border-top text-center">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="status-indicator status-online me-2"></span>
                    System Active • Last updated: <span id="lastUpdateFooter">Just now</span>
                </div>
                <p class="mt-2">&copy; 2025 Employee Attendance System</p>
            </footer>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateClock() {
            const now = new Date();

            const timeString = now.toLocaleTimeString('en-US', {
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('digitalClock').textContent = timeString;

            const dateString = now.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('dateDisplay').textContent = dateString;

            document.getElementById('lastUpdate').textContent = now.toLocaleTimeString('en-US');
            document.getElementById('lastUpdateFooter').textContent = now.toLocaleTimeString('en-US');
        }

        setInterval(updateClock, 1000);
        updateClock();

        $(function() {
            $('#employeeIdInput').on('keypress', function(e) {
                if (e.which === 13) {
                    let employeeId = $(this).val().trim();
                    if (!employeeId) {
                        showMessage('Please enter your Employee ID', 'error');
                        return;
                    }

                    $(this).prop('disabled', true);
                    showMessage('Processing attendance...', 'info');

                    $.ajax({
                        url: "{{ route('attendance.store') }}",
                        method: "POST",
                        data: {
                            employee_id: employeeId
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'info') {
                                showMessage(response.message,
                                    'info');
                                $('#employeeIdInput').val('').prop('disabled', false).focus();
                                return;
                            }
                            const emp = response.employee;
                            showSuccessMessage(emp, response.message);
                            $('#employeeIdInput').val('').prop('disabled', false).focus();
                            addRecentActivity(emp);
                        },
                        error: function(xhr) {
                            let errorMsg = 'Error recording attendance';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMsg = Object.values(xhr.responseJSON.errors).flat().join(
                                    ', ');
                            }
                            showMessage(errorMsg, 'error');
                            $('#employeeIdInput').prop('disabled', false).focus();
                        }
                    });
                }
            });
        });

        function showMessage(message, type) {
            const alertClass = type === 'error' ? 'error-message' :
                type === 'success' ? 'success-message' : 'alert alert-info';

            $('#messageContainer').html(`
                <div class="${alertClass}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-${type === 'error' ? 'exclamation-triangle' : 'info-circle'} fs-4 me-3"></i>
                        <div>
                            <strong>${message}</strong>
                        </div>
                    </div>
                </div>
            `).show();

            setTimeout(() => {
                $('#messageContainer').fadeOut();
            }, 3000);
        }

        function showSuccessMessage(employee, message) {
            const imgHtml = employee.image ?
                `<img src="${employee.image}" alt="Employee Photo" class="employee-photo rounded-circle mb-3">` :
                `<div class="bg-secondary rounded-circle employee-photo d-flex align-items-center justify-content-center mb-3">
                <i class="bi bi-person fs-1 text-white"></i>
           </div>`;

            const isCheckIn = !!employee.attended_at && !employee.checked_out_at;
            const isCheckOut = !!employee.checked_out_at;

            const timeLabel = isCheckOut ? 'Check-Out Time:' : 'Check-In Time:';
            const timeValue = isCheckOut ? employee.checked_out_at : employee.attended_at;
            const statusLabel = isCheckOut ? 'Checked Out' : 'Checked In';

            $('#messageContainer').html(`
        <div class="success-message">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    ${imgHtml}
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle fs-3 me-3"></i>
                        <h4 class="mb-0">${message}</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <strong>Name:</strong> ${employee.full_name}
                        </div>
                        <div class="col-sm-6 mb-2">
                            <strong>Age:</strong> ${employee.age}
                        </div>
                        <div class="col-sm-6 mb-2">
                            <strong>${timeLabel}</strong> ${timeValue}
                        </div>
                        <div class="col-sm-6 mb-2">
                            <strong>Status:</strong> <span class="badge bg-light text-dark">${statusLabel}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);

            setTimeout(() => {
                $('#messageContainer').fadeOut(500, () => {
                    $('#messageContainer').empty().show();
                });
            }, 3000);
        }

        function addRecentActivity(employee) {
            const isCheckOut = !!employee.checked_out_at;
            const status = isCheckOut ? 'Time Out' : 'Time In';
            const timestamp = isCheckOut ? employee.checked_out_at : employee.attended_at;

            const time = new Date(timestamp);
            const timeString = time.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            if ($('#recentActivity .col-12').length >= 5) {
                $('#recentActivity .col-12:gt(2)').remove();
            }

            const iconClass = isCheckOut ? 'text-danger' : 'text-success';
            const departmentName = employee.department || 'N/A';
            const activityHtml = `
                <div class="col-12 mb-3">
                    <div class="stats-card" style="border-left: 4px solid ${isCheckOut ? '#dc3545' : '#28a745'};">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock ${iconClass} fs-4 me-3"></i>
                                <div>
                                    <h6 class="mb-0">${employee.full_name}</h6>
                                    <small class="text-muted text-left">${status}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <strong class="text-dark">${timeString}</strong>
                                <br>
                                <small class="text-muted">${departmentName}</small>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#recentActivity').prepend(activityHtml);
            // Keep only the last 8 activities
            $('#recentActivity .col-12:gt(7)').remove();
        }

        $(document).ready(function() {
            $('#employeeIdInput').focus();
        });
    </script>
</body>

</html>