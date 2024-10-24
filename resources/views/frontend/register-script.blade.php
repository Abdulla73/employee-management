

<script>
    $('#registration-form').on('submit', function(event) {
        event.preventDefault();

        const name = $('#name').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirm-password').val();

        if (name === '' || email === '' || password === '' || confirmPassword === '') {
            alert('All fields are required.');
            return;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            return;
        }

        var formData = new FormData(this);

        $.ajax({
            method: "POST",
            url: '/user/register',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(res) {
                if (res.success) {
                    alert('Registration successful!');
                    $.get('/', function(data) {
                    $('.container').html(data);

                    window.history.pushState({}, '', '/');
                });
                }
            },
            error: function(res) {
                alert('Registration failed. Please try again.');
            }
        });
    });
</script>
