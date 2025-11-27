@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="form-container">

    <h2>Create an Account</h2>
    <p>Select your role and create an account.</p>

    <!-- 🔥 SUCCESS MESSAGE -->
    @if (session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <!-- FULL NAME -->
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Enter your name" required>

        <!-- EMAIL -->
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <!-- PASSWORD -->
        <label>Password</label>
        <input type="password" name="password" placeholder="Create a password" required>

        <!-- ROLE SELECT -->
        <label>Select Role</label>
        <select name="role" required>
            <option value="">-- choose role --</option>
            <option value="client">Client</option>
            <option value="worker">Worker</option>
        </select>

        <button type="submit" class="btn-primary">Register</button>

        <p class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </p>
    </form>

</div>
@endsection
