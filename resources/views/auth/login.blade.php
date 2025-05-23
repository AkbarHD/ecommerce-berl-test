@extends('frontend.layouts.template')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
@endsection

@section('content')
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 col-sm-9">
                    <div class="login-card">
                        <div class="login-header">
                            <div class="app-icon">
                                <i class="fas fa-shopping-cart fa-3x mb-1 animated-icon"></i>
                            </div>
                            <h4 class="mb-1">Welcome Back</h4>
                            <p class="mb-0 subtitle">Sign in to continue shopping</p>
                        </div>
                        <div class="login-body">
                            <form action="{{ route('loginProses') }}" method="post" autocomplete="off">
                                @csrf
                                @error('errors')
                                    <div class="alert alert-danger text-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                    </div>
                                @enderror

                                <div class="input-group">
                                    <div class="position-relative w-100">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input class="form-control icon-input @error('email') is-invalid @enderror"
                                            type="email" name="email" placeholder="Email Address"
                                            value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-2">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="input-group">
                                    <div class="position-relative w-100">
                                        <i class="fas fa-lock input-icon @error('password') is-invalid @enderror"></i>
                                        <input class="form-control icon-input" type="password" name="password"
                                            id="password" placeholder="Password">
                                        <span class="password-toggle" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-2">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="remember-me">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                    <a href="javascript:void(0)" class="forgot-link">Forgot Password?</a>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-lg login-btn">
                                        Sign In
                                    </button>
                                </div>

                                <div class="register-prompt text-center mt-4">
                                    <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert untuk success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#38c172',
                    timer: 3000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @endif
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
