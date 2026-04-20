{{-- Admin Login Page --}}
@extends('layouts.app')

@section('title', 'Admin Login — Power Supply Feedback System')

@section('content')

    <div class="login-wrapper">
        <div class="card login-card">
            <h2>Admin Login</h2>
            <p class="login-subtitle">Sign in to manage complaints</p>

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/admin') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@power.gov" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width:100%">Sign In</button>

                <p class="text-muted text-center mt-2" style="font-size:0.8rem;">
                    Demo: admin@power.gov / admin123
                </p>
            </form>
        </div>
    </div>

@endsection
