<x-app-layout>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

        <title>Attendance Records</title>
        <style>
            body {
                background-color: #f8f9fa;
            }

            .record-card {
                transition: all 0.3s ease;
                border: 1px solid #dee2e6;
            }

            .record-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .btn-action {
                transition: all 0.2s ease;
            }

            .btn-action:hover {
                transform: translateX(5px);
            }

            .stats-card {
                background: #212529;
                color: white;
            }

            .status-badge {
                transition: all 0.3s ease;
            }

            .time-in {
                background: linear-gradient(135deg, #28a745, #20c997);
            }

            .time-out {
                background: linear-gradient(135deg, #dc3545, #e83e8c);
            }

            .present {
                background: linear-gradient(135deg, #007bff, #6610f2);
            }
        </style>
    </head>

    <body>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
        <main>
            <div class="container py-4">
                @yield('content')
            </div>
        </main>

    </body>

    </html>
</x-app-layout>
