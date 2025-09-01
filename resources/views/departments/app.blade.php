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

        <title>Departments</title>
        <style>
            body {
                background-color: #f8f9fa;
            }

            .department-card {
                transition: all 0.3s ease;
                border: 1px solid #dee2e6;
            }

            .department-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .btn-action {
                transition: all 0.2s ease;
            }

            .btn-action:hover {
                transform: translateX(5px);
            }

            .modal-content {
                border: none;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .stats-card {
                background: linear-gradient(135deg, #212529 0%, #495057 100%);
                color: white;
            }

            .department-icon {
                width: 3rem;
                height: 3rem;
                background: #212529;
                color: white;
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
            @include('departments.modal')
            @include('departments.script')
            @include('departments.view')
        </main>

    </body>

    </html>
</x-app-layout>
