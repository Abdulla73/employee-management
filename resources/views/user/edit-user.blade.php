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
        <div class="form-container">
            <h2>Edit User</h2>
            <form action="{{ route('employee-panel.users.update.user', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-section">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="confirm-pssword">Confirm-Password</label>
                        <input type="password" id="confirm-pssword" name="confirm-pssword">
                    </div>

                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    <script></script>
@endsection
@endsection
