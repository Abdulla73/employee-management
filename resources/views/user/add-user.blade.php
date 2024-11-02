@extends('layout.app')

@section('styles')
    <style>
        .form-container {
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-family: Arial, sans-serif;
        }

        .form-header {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
            border-top: 2px solid #007bff;
            padding-top: 15px;
        }

        .form-section h3 {
            color: #007bff;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="confirm-pssword"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <dvi class="form-container">
            <h2>Add User</h2>
            <form action="{{ route('employee-panel.users.store.user') }}" method="POST">
                @csrf
                <div class="form-section">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <span id="email-error" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm-pssword">Confirm-Password</label>
                        <input type="password" id="confirm-pssword" name="confirm-pssword" required>
                    </div>

                    <button type="submit" class="btn-submit .btn-submit">Submit</button>
                </div>
            </form>
        </dvi>
    </div>

@section('scripts')
    <script>
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const submitButton = document.querySelector('.btn-submit');
            const emailError = document.getElementById('email-error');

            if (email) {
                fetch("{{ route('employee-panel.users.check.email') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            emailError.textContent = 'user with this mail already exists.';
                            submitButton.disabled = true;
                            submitButton.style.backgroundColor = '#ddd';
                        } else {
                            emailError.textContent = '';
                            submitButton.disabled = false;
                            submitButton.style.backgroundColor = '#007bff';
                        }
                    });
            } else {
                emailError.textContent = '';
                submitButton.disabled = false;
            }
        });
    </script>
@endsection
@endsection
