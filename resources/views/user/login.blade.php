@extends('frontend.login-app')

@section('login-section')
    <div class="login-container">
        <div class="form-section">
            <h2>Login to Your Account</h2>
            <form id="login-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group w-100">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email"
                        required>
                </div>
                <div class="form-group w-100">
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
        </div>
        <div class="image-section"></div>
    </div>
@endsection

