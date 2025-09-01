
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var birthdayInput = document.getElementById('birthday');
        var ageInput = document.getElementById('age');
        if (birthdayInput) {
        birthdayInput.addEventListener('change', function() {
            var birthDate = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
            }
            ageInput.value = (this.value ? age : '');

            console.log(age);
            
        });
        }
    });
</script>