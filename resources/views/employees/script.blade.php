<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.birthday').forEach(function (birthdayInput) {
            birthdayInput.addEventListener('change', function () {
                const birthDate = new Date(this.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                const container = this.closest('.modal-body') || this.closest('form');
                const ageInput = container.querySelector('.age');
                if (ageInput) {
                    ageInput.value = this.value ? age : '';
                }

                console.log(`Calculated age: ${age}`);
            });
        });
    });
</script>
