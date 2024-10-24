@extends('frontend.register-app')

@section('register')
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
@endsection
