<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #228eac, #d4db10);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.6);
            padding: 0;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            height: 600px;
            display: flex;
            overflow: hidden;
        }

        .form-section {
            flex: 1;
            padding: 50px;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-section h2 {
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .form-control {
            border-radius: 30px;
            padding: 10px 20px;
            margin-bottom: 20px;
        }

        .btn-login {
            background-color: #4facfe;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #00f2fe;
        }

        .image-section {
            flex: 1;
            background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/66f2c84d-51b2-4552-856b-6b998af96a1f/dhgrt9d-ae9efda3-4639-48f8-8147-c4c0160077c2.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzY2ZjJjODRkLTUxYjItNDU1Mi04NTZiLTZiOTk4YWY5NmExZlwvZGhncnQ5ZC1hZTllZmRhMy00NjM5LTQ4ZjgtODE0Ny1jNGMwMTYwMDc3YzIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.192Lecg_IOeH619Il0ZHmHy2bNofDJjOPAKtAyZuZx8');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="form-section">
            <h2>Login to Your Account</h2>
            <form id="login-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group w-100">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group w-100">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"
                        required>
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
        </div>
        <div class="image-section"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                        $.get('/employee/employeeList', function(data) {
                            $('html').html(data);

                            window.history.pushState({}, '', '/employee/employeeList');
                        });
                    }
                },
                error: function(res) {
                    alert('Login failed. Please try again.');
                }
            });
        });
    </script>
</body>

</html>
