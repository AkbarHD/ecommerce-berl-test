@extends('frontend.layouts.template')

@section('title', 'Register')

@section('css')
    <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
@endsection

@section('content')
    <div class="register-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="register-card">
                        <div class="register-header">
                            <div class="app-icon">
                                <i class="fas fa-shopping-cart fa-3x mb-1 animated-icon"></i>
                            </div>
                            <h4 class="mb-1">Create Account</h4>
                            <p class="mb-0 subtitle">Join our shopping community</p>
                        </div>
                        <div class="register-body">
                            <form id="registerForm" action="{{ route('registerProses') }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @if (session('success'))
                                    <div class="alert alert-success text-center">
                                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger text-center mb-3">
                                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-user input-icon"></i>
                                                <input class="form-control icon-input @error('name') is-invalid @enderror"
                                                    type="text" name="name" placeholder="Full Name"
                                                    value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-12">
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
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-phone input-icon"></i>
                                                <input class="form-control icon-input @error('no_hp') is-invalid @enderror"
                                                    type="text" name="no_hp" placeholder="Phone Number"
                                                    value="{{ old('no_hp') }}">
                                            </div>
                                            @error('no_hp')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-venus-mars input-icon"></i>
                                                <select class="form-select icon-input @error('gender') is-invalid @enderror"
                                                    name="gender">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="female"
                                                        {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                            @error('gender')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Logo (optional) -->
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-image input-icon"></i>
                                                <div class="custom-file-upload">
                                                    <input type="file" name="logo" id="logo"
                                                        class="file-input @error('logo') is-invalid @enderror">
                                                    <label for="logo"
                                                        class="form-control icon-input text-muted file-label">
                                                        Choose Logo (Optional)
                                                    </label>
                                                </div>
                                                <div id="file-name" class="selected-file mt-1"></div>
                                            </div>
                                            @error('logo')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-map-marker-alt input-icon"></i>
                                                <textarea class="form-control icon-input @error('alamat') is-invalid @enderror" name="alamat" placeholder="Address"
                                                    rows="3">{{ old('alamat') }}</textarea>
                                            </div>
                                            @error('alamat')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-lock input-icon"></i>
                                                <input
                                                    class="form-control icon-input @error('password') is-invalid @enderror"
                                                    type="password" name="password" id="password" placeholder="Password">
                                                <span class="password-toggle"
                                                    onclick="togglePassword('password', 'toggleIcon1')">
                                                    <i class="fas fa-eye" id="toggleIcon1"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="position-relative w-100">
                                                <i class="fas fa-lock input-icon"></i>
                                                <input
                                                    class="form-control icon-input @error('password_confirmation') is-invalid @enderror"
                                                    type="password" name="password_confirmation"
                                                    id="password_confirmation" placeholder="Confirm Password">
                                                <span class="password-toggle"
                                                    onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                                    <i class="fas fa-eye" id="toggleIcon2"></i>
                                                </span>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms"
                                        required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-decoration-none">Terms &
                                            Conditions</a>
                                    </label>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-lg register-btn">
                                        Create Account
                                    </button>
                                </div>

                                <div class="login-prompt text-center mt-4">
                                    <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
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
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);

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

        // Show file name when selected
        document.getElementById('logo').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });

        document.getElementById('registerForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');

            // buttonya di disabled dan spennernya tampil
            submitBtn.disabled = true;
            btnText.textContent = 'Mendaftar...';
            btnSpinner.classList.remove('d-none');
        });
    </script>
@endsection
