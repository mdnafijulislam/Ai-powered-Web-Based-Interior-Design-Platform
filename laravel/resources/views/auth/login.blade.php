@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="form-container">

    <h2>Login</h2>
    <p>Access your account</p>

    @if (session('error'))
        <div class="error-box">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>

        <button type="submit" class="btn-primary">Login</button>

        <p class="login-link">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </form>

</div>
@endsection
