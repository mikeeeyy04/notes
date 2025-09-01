<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <style>
            body {
                background-color: #f8f9fa;
            }

            .stat-card {
                transition: all 0.3s ease;
                border: 1px solid #dee2e6;
            }

            .stat-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .stat-icon {
                width: 3rem;
                height: 3rem;
                background: #212529;
                color: white;
            }

            .chart-container {
                position: relative;
                height: 300px;
            }

            .activity-item {
                transition: background-color 0.2s ease;
            }

            .activity-item:hover {
                background-color: #f8f9fa;
            }

            .progress-bar-custom {
                background: linear-gradient(90deg, #212529 0%, #495057 100%);
            }

            .btn-action {
                transition: all 0.2s ease;
            }

            .btn-action:hover {
                transform: translateX(5px);
            }
        </style>
    </head>

    <body>
        <main>
            <div class="container py-4">
                <!-- Header -->
                <header class="pb-3 mb-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                                class="bi bi-speedometer2" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                                <path fill-rule="evenodd"
                                    d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3" />
                            </svg>
                            <h2 class="ms-2">Dashboard</h2>
                        </a>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-dark">
                                <i class="bi bi-arrow-clockwise me-2"></i>Refresh
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Featured Statistics Hero -->
                <div class="p-5 mb-4 bg-dark text-white rounded-3">
                    <div class="container-fluid py-2">
                        <h1 class="display-5 fw-bold">Welcome Back!</h1>
                        <p class="col-md-8 fs-4">Here's your organization overview with key metrics and summaries.</p>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark-text fs-1 me-3"></i>
                                    <div>
                                        <h3 class="mb-0">{{ number_format($notesCount) }}</h3>
                                        <small class="text-white-50">Total Notes</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people fs-1 me-3"></i>
                                    <div>
                                        <h3 class="mb-0">{{ number_format($employeesCount) }}</h3>
                                        <small class="text-white-50">Active Employees</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-building-fill fs-1 me-3"></i>
                                    <div>
                                        <h3 class="mb-0">{{ number_format($departmentsCount) }}</h3>
                                        <small class="text-white-50">Departments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards Row -->
                <div class="row align-items-md-stretch mb-4">
                    <!-- Notes Statistics -->
                    <div class="col-md-6 mb-3">
                        <div class="h-100 p-4 bg-light border rounded-3 stat-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h3 class="fw-bold">Notes Activity</h3>
                                    <p class="text-muted mb-3">Track your note creation and engagement</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center p-3 bg-white rounded">
                                                <h4 class="text-primary mb-1">{{ number_format($notesCount) }}</h4>
                                                <small class="text-muted">Total Notes</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3 bg-white rounded">
                                                <h4 class="text-success mb-1">+{{ number_format($thisWeekCount) }}</h4>
                                                <small class="text-muted">This Week</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stat-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-text fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Statistics -->
                    <div class="col-md-6 mb-3">
                        <div class="h-100 p-4 text-white bg-dark rounded-3 stat-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h3 class="fw-bold">Employee Management</h3>
                                    <p class="text-white-50 mb-3">Current workforce overview</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center p-3 bg-white bg-opacity-10 rounded">
                                                <h4 class="text-info mb-1">{{ number_format($employeesCount) }}</h4>
                                                <small class="text-white-50">Active</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3 bg-white bg-opacity-10 rounded">
                                                <h4 class="text-warning mb-1">
                                                    +{{ number_format($employeeThisWeekCount) }}</h4>
                                                <small class="text-white-50">New Hires</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 3rem; height: 3rem;">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Analytics -->
                <div class="row align-items-md-stretch mb-4">
                    <!-- Activity Chart -->
                    <div class="col-lg-8 mb-3">
                        <div class="h-100 p-4 bg-light border rounded-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold">Chart Summary</h4>
                                {{-- <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="timeRange" id="range7"
                                        autocomplete="off" checked>
                                    <label class="btn btn-outline-dark btn-sm" for="range7">7D</label>
                                    <input type="radio" class="btn-check" name="timeRange" id="range30"
                                        autocomplete="off">
                                    <label class="btn btn-outline-dark btn-sm" for="range30">30D</label>
                                    <input type="radio" class="btn-check" name="timeRange" id="range90"
                                        autocomplete="off">
                                    <label class="btn btn-outline-dark btn-sm" for="range90">90D</label>
                                </div> --}}
                            </div>
                            <div class="chart-container">
                                <canvas id="activityChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Department Overview -->
                    <div class="col-lg-4 mb-3">
                        <div class="h-100 p-4 bg-white border rounded-3">
                            <h4 class="fw-bold mb-3">Departments</h4>
                            <div class="chart-container">
                                <canvas id="departmentChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity and Quick Actions -->
                <div class="row align-items-md-stretch">
                    {{-- <!-- Recent Activity -->
                    <div class="col-lg-8 mb-3">
                        <div class="h-100 p-4 bg-white border rounded-3">
                            <h4 class="fw-bold mb-3">
                                <i class="bi bi-clock-history me-2"></i>Recent Activity
                            </h4>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item activity-item border-0 px-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 2.5rem; height: 2.5rem;">
                                            <i class="bi bi-person-plus-fill"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">New employee added to Engineering</h6>
                                            <p class="mb-1 text-muted">John Smith joined the development team</p>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item activity-item border-0 px-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 2.5rem; height: 2.5rem;">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Project milestone completed</h6>
                                            <p class="mb-1 text-muted">Q3 goals achieved ahead of schedule</p>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item activity-item border-0 px-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 2.5rem; height: 2.5rem;">
                                            <i class="bi bi-file-earmark-plus-fill"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">25 new notes created</h6>
                                            <p class="mb-1 text-muted">Team collaboration increasing</p>
                                            <small class="text-muted">3 hours ago</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item activity-item border-0 px-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 2.5rem; height: 2.5rem;">
                                            <i class="bi bi-info-circle-fill"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">System maintenance scheduled</h6>
                                            <p class="mb-1 text-muted">Planned downtime: Sunday 2 AM - 4 AM</p>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-top">
                                <a href="#" class="btn btn-outline-dark">
                                    <i class="bi bi-eye me-2"></i>View All Activity
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Quick Actions -->
                    <div class="col-lg-12 mb-3">
                        <div class="h-100 p-4 bg-light border rounded-3">
                            <h4 class="fw-bold mb-4">
                                <i class="bi bi-lightning-charge me-2"></i>Quick Actions
                            </h4>
                            <div class="row g-3">

                                <!-- Card Item -->
                                
                                <a href="/notes"
                                    class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 bg-dark text-white hover-shadow">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="bi bi-plus-lg fs-3 me-3"></i>
                                            <span class="fs-6 fw-semibold">Create Note</span>
                                            <i class="bi bi-arrow-right ms-auto"></i>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="/employees"
                                    class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="bi bi-person-plus fs-3 text-dark me-3"></i>
                                            <span class="fs-6 fw-semibold text-dark">Add New Employee</span>
                                            <i class="bi bi-arrow-right ms-auto text-muted"></i>
                                        </div>
                                    </div>
                                </a>

                                <a href="/reports" class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="bi bi-bar-chart fs-3 text-dark me-3"></i>
                                            <span class="fs-6 fw-semibold text-dark">View Reports</span>
                                            <i class="bi bi-arrow-right ms-auto text-muted"></i>
                                        </div>
                                    </div>
                                </a>

                                <a href="/departments" class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="bi bi-building-fill fs-3 text-dark me-3"></i>
                                            <span class="fs-6 fw-semibold text-dark">Manage Departments</span>
                                            <i class="bi bi-arrow-right ms-auto text-muted"></i>
                                        </div>
                                    </div>
                                </a>

                                <a href="/profile" class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="bi bi-person-circle fs-3 text-dark me-3"></i>
                                            <span class="fs-6 fw-semibold text-dark">Profile</span>
                                            <i class="bi bi-arrow-right ms-auto text-muted"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="mt-4 p-3 bg-white rounded border">
                                <h6 class="fw-bold mb-2">System Status</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small>Performance</small>
                                    <span class="badge bg-success">Excellent</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: 94%"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Footer -->
                    <footer class="pt-3 mt-4 text-muted border-top">
                        &copy; 2025 Dashboard System
                    </footer>
                </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const chartLabels = @json($days);
            const notesData = @json($notesData);
            const employeeData = @json($employeeData);

            const activityCtx = document.getElementById('activityChart').getContext('2d');
            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Notes Created',
                        data: notesData,
                        borderColor: '#212529',
                        backgroundColor: 'rgba(33, 37, 41, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Employees Added',
                        data: employeeData,
                        borderColor: '#6c757d',
                        backgroundColor: 'rgba(108, 117, 125, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        }
                    }
                }
            });

            const departmentLabels = @json($departmentLabels);
            const departmentCounts = @json($departmentCounts);

            const departmentCtx = document.getElementById('departmentChart').getContext('2d');
            new Chart(departmentCtx, {
                type: 'doughnut',
                data: {
                    labels: departmentLabels,
                    datasets: [{
                        data: departmentCounts,
                        backgroundColor: [
                            '#212529',
                            '#495057',
                            '#6c757d',
                            '#adb5bd',
                            '#ced4da',
                            '#e9ecef',
                            '#f8f9fa',
                            '#dee2e6'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });


            // Add hover effects and animations
            document.addEventListener('DOMContentLoaded', function() {
                // Animate numbers on load
                const numbers = document.querySelectorAll('h3, h4');
                numbers.forEach(num => {
                    const text = num.textContent;
                    if (text.match(/^\d+$/)) {
                        const finalValue = parseInt(text);
                        let currentValue = 0;
                        const increment = finalValue / 30;
                        const timer = setInterval(() => {
                            currentValue += increment;
                            if (currentValue >= finalValue) {
                                clearInterval(timer);
                                num.textContent = finalValue.toLocaleString();
                            } else {
                                num.textContent = Math.floor(currentValue).toLocaleString();
                            }
                        }, 50);
                    }
                });
            });
        </script>
    </body>

    </html>
</x-app-layout>
