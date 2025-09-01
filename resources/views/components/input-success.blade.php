@if ($message)
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function () {
            const alertEl = document.getElementById('success-alert');
            if (alertEl) {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
                bsAlert.close();
            }
        }, 3000);
    </script>
@endif
