@extends('components.dashmaster')

@section('body')
<div class="content-wrapper profile-page">
    <div class="container-fluid profile-shell">
        <header class="profile-header">
            <div>
                <h1><i class="fas fa-user-edit"></i> Edit My Profile</h1>
                <p>Update your name, contact information, gender, and profile image.</p>
            </div>
            <a href="{{ route('profile.show') }}" class="profile-btn profile-btn-light"><i class="fas fa-arrow-left"></i> My Profile</a>
        </header>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-card profile-form">
            @csrf
            @method('PUT')

            <div class="image-editor">
                <img src="{{ $user->profile_image ? asset('uploads/profile_images/'.$user->profile_image) : asset('dist/img/avatar5.png') }}" alt="Profile image" id="profilePreview" class="profile-avatar">
                <div>
                    <label for="profile_image">Profile image</label>
                    <input type="file" name="profile_image" id="profile_image" accept="image/jpeg,image/png,image/gif,image/webp">
                    <small>JPG, PNG, GIF, or WebP. Maximum 2 MB.</small>
                </div>
            </div>

            <div class="form-grid">
                <div class="field">
                    <label for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                </div>
                <div class="field">
                    <label for="secondname">Second name</label>
                    <input type="text" id="secondname" name="secondname" value="{{ old('secondname', $user->secondname) }}" required>
                </div>
                <div class="field">
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                </div>
                <div class="field field-wide">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="field">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('gender', strtolower($user->gender ?? '')) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <section class="assignment-note">
                <i class="fas fa-lock"></i>
                <div><strong>Account assignment</strong><span>Your role, school, class, status, and permissions can only be changed by an authorized administrator.</span></div>
            </section>

            <div class="profile-actions form-actions">
                <button type="submit" class="profile-btn profile-btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                <a href="{{ route('profile.show') }}" class="profile-btn profile-btn-light"><i class="fas fa-times"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('profile.styles')
<script>
document.getElementById('profile_image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) document.getElementById('profilePreview').src = URL.createObjectURL(file);
});
</script>
@endsection
