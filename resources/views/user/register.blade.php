<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #2693b1, #feb47b);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .registration-form {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .registration-form h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 50px;
        }

        .btn-custom {
            border-radius: 50px;
            padding: 10px 20px;
        }

        .btn-register {
            background-color: #ff7e5f;
            color: #fff;
        }

        .btn-register:hover {
            background-color: #feb47b;
        }

        .btn-login {
            background-color: #feb47b;
            color: #fff;
        }

        .btn-login:hover {
            background-color: #ff7e5f;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="registration-form">
                    <h2>User Registration</h2>
                    <form id="registration-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                placeholder="Confirm your password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-custom btn-register">Confirm Registration</button>
                            <a href="/" class="btn btn-custom btn-login">Go to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
</body>

</html>
