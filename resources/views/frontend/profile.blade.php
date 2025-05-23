@extends('frontend.layouts.template')
@section('title', 'Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endsection

@section('content')
    <div class="profile-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <!-- Profile Header Card -->
                    <div class="profile-header-card mb-4">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                @if ($user->logo)
                                    <img src="{{ asset($user->logo) }}" alt="Profile Picture" class="avatar-img">
                                @else
                                    <div class="avatar-placeholder">
                                        <i class="fas fa-user fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="profile-info">
                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p class="mb-0 subtitle">{{ $user->email }}</p>
                                <span class="badge badge-role mt-2">
                                    {{ $user->role == 1 ? 'Admin' : 'User' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details Card -->
                    <div class="profile-card">
                        <div class="profile-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="section-title mb-0">
                                    <i class="fas fa-user-circle me-2"></i>Profile Information
                                </h5>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">
                                    <i class="fas fa-edit me-1"></i>Edit Profile
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-user info-icon"></i>Full Name
                                        </label>
                                        <p class="info-value">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-envelope info-icon"></i>Email Address
                                        </label>
                                        <p class="info-value">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-phone info-icon"></i>Phone Number
                                        </label>
                                        <p class="info-value">{{ $user->no_hp }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-venus-mars info-icon"></i>Gender
                                        </label>
                                        <p class="info-value">{{ ucfirst($user->gender) }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-map-marker-alt info-icon"></i>Address
                                        </label>
                                        <p class="info-value">{{ $user->alamat }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-calendar-alt info-icon"></i>Member Since
                                        </label>
                                        <p class="info-value">{{ $user->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label class="info-label">
                                            <i class="fas fa-clock info-icon"></i>Last Updated
                                        </label>
                                        <p class="info-value">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <!-- Profile Picture Upload -->
                            <div class="col-12 mb-4">
                                <div class="text-center">
                                    <div class="upload-preview mb-3">
                                        @if ($user->logo)
                                            <img src="{{ asset($user->logo) }}" alt="Profile Picture" class="preview-img"
                                                id="previewImg">
                                        @else
                                            <div class="preview-placeholder" id="previewPlaceholder">
                                                <i class="fas fa-user fa-2x"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="upload-btn-wrapper">
                                        <button type="button" class="btn btn-outline-primary" id="triggerUpload">
                                            <i class="fas fa-camera me-1"></i>Change Photo
                                        </button>
                                        <input type="file" name="logo" id="logoInput" accept="image/*"
                                            style="display: none;">
                                    </div>

                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="position-relative w-100">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text"
                                            class="form-control icon-input @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}"
                                            required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="position-relative w-100">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email"
                                            class="form-control icon-input @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}"
                                            required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="no_hp" class="form-label">Phone Number</label>
                                    <div class="position-relative w-100">
                                        <i class="fas fa-phone input-icon"></i>
                                        <input type="text"
                                            class="form-control icon-input @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                            required>
                                    </div>
                                    @error('no_hp')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="gender" class="form-label">Gender</label>
                                    <div class="position-relative w-100">
                                        <i class="fas fa-venus-mars input-icon"></i>
                                        <select class="form-select icon-input @error('gender') is-invalid @enderror"
                                            id="gender" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="male"
                                                {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-group">
                                    <label for="alamat" class="form-label">Address</label>
                                    <div class="position-relative w-100">
                                        <i class="fas fa-map-marker-alt input-icon"></i>
                                        <textarea class="form-control icon-input @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                            rows="3" required>{{ old('alamat', $user->alamat) }}</textarea>
                                    </div>
                                    @error('alamat')
                                        <div class="text-danger mt-1">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('triggerUpload').addEventListener('click', function() {
            document.getElementById('logoInput').click();
        });

        document.getElementById('logoInput').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('previewImg');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    // Kalau belum ada previewImg, tampilkan placeholder
                    document.getElementById('previewPlaceholder').innerHTML =
                        `<img src="${e.target.result}" alt="Preview" class="preview-img" id="previewImg">`;
                }
            };
            if (this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>

@endsection
