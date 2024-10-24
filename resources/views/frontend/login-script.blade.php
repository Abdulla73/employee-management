


<script>
    $('#login-form').on('submit', function(event) {
        event.preventDefault();

        const email = $('#email').val();
        const password = $('#password').val();

        if (email === '' || password === '') {
            alert('Please Enter Email and password.');
            return;
        }

        var formData = new FormData(this);

        $.ajax({
            method: "POST",
            url: '/',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(res) {
                if (res.success) {
                    alert('Login successful!');
                    $.get('/employee-management/Dashboard', function(data) {
                        $('html').html(data);
                        window.history.pushState({}, '', '/employee-management/Dashboard');
                    });
                }
            },
            error: function(res) {
                alert('Login failed. Please try again.');
            }
        });
    });
</script>
