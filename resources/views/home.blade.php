<x-layout />
@include('partials.header')

<style>
/* Enhanced Slider Styling */
.slider-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.slider-container .col-md-10 {
    width: 100%;
    max-width: 100%;
    flex: 0 0 100%;
    display: flex;
    justify-content: center;
}

.slider-container .card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 18px 45px rgba(17, 24, 39, 0.14);
    background: transparent;
    width: 100%;
    max-width: none;
}

.slider-container .card-header {
    display: none;
}

.slider-container .card-body {
    padding: 0;
}

.carousel {
    position: relative;
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
    margin: 0 auto;
}

.carousel-inner {
    border-radius: 12px;
    position: relative;
}

.carousel-item {
    position: relative;
    height: 500px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
    border-radius: 12px;
    transition: transform 0.5s ease;
    display: block;
    margin: 0 auto;
}

.carousel-item:hover img {
    transform: scale(1.05);
}

/* Navigation buttons - perfectly centered and styled */
.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    height: 60px;
    background: rgba(20, 59, 50, 0.92);
    border: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    z-index: 10;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(20, 59, 50, 0.28);
    opacity: 0.8;
}

.carousel-control-prev {
    left: 25px;
}

.carousel-control-next {
    right: 25px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: #143b32;
    border-color: #fff;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 12px 35px rgba(20, 59, 50, 0.38);
    opacity: 1;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 24px;
    height: 24px;
    filter: brightness(0) invert(1);
}

/* Caption styling */
.carousel-caption {
    background: rgba(20, 59, 50, 0.82);
    bottom: 0;
    left: 0;
    right: 0;
    padding: 40px 30px 25px;
    border-radius: 0 0 12px 12px;
    text-align: center;
}

.carousel-caption p {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
    color: #fff;
    line-height: 1.4;
}



/* Responsive design */
@media (max-width: 1200px) {
    .carousel-item {
        height: 450px;
    }

    .slider-container {
        max-width: 98%;
    }
}

@media (max-width: 768px) {
    .carousel-item {
        height: 350px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
    }

    .carousel-control-prev {
        left: 15px;
    }

    .carousel-control-next {
        right: 15px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 20px;
        height: 20px;
    }

    .carousel-caption p {
        font-size: 1rem;
    }

    .slider-container {
        padding: 0 5px;
    }
}

@media (max-width: 576px) {
    .carousel-item {
        height: 280px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 45px;
        height: 45px;
    }

    .carousel-control-prev {
        left: 10px;
    }

    .carousel-control-next {
        right: 10px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 18px;
        height: 18px;
    }

    .carousel-indicators [data-target] {
        width: 10px;
        height: 10px;
        margin: 0 4px;
    }
}

/* Service cards styling improvements */
.service-item img {
    border-radius: 50%;
    padding: 8px;
    background: #e9f7ef;
    border: 1px solid #bee5cc;
    box-shadow: 0 5px 15px rgba(20, 59, 50, 0.12);
    transition: all 0.3s ease;
}

.service-item:hover img {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(20, 59, 50, 0.18);
}

.service-item h5 {
    color: #143b32;
    font-weight: 700;
    margin-top: 1rem;
}

.service-item p {
    color: #666;
    line-height: 1.6;
}

.card.shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(20, 59, 50, 0.12) !important;
}

/* Button styling */
.button {
    background: #143b32;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(20, 59, 50, 0.16);
}

.button:hover {
    transform: translateY(-2px);
    background: #1f6f5b;
    box-shadow: 0 8px 25px rgba(20, 59, 50, 0.24);
    color: white;
    text-decoration: none;
}

.home-actions {
    display: flex;
    justify-content: center;
    gap: 14px;
    margin-top: 54px;
    flex-wrap: wrap;
}

.auth-modal .modal-content {
    border: 0;
    border-radius: 12px;
    box-shadow: 0 24px 70px rgba(17, 24, 39, 0.28);
    pointer-events: auto;
}

.auth-modal {
    z-index: 20000 !important;
}

body.modal-open {
    overflow: auto !important;
    padding-right: 0 !important;
}

.modal-backdrop {
    display: none !important;
}

.auth-modal .modal-header {
    background: #143b32;
    color: #fff;
    border-radius: 12px 12px 0 0;
    border-bottom: 0;
}

.auth-modal .modal-title {
    font-weight: 700;
}

.auth-modal .close {
    background: transparent;
    border: 0;
    color: #fff;
    font-size: 28px;
    line-height: 1;
    opacity: 1;
}

.auth-form-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.auth-field {
    margin-bottom: 16px;
}

.auth-field label {
    color: #374151;
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 6px;
}

.auth-field input,
.auth-field select {
    border: 1px solid #d1d5db;
    border-radius: 8px;
    color: #111827;
    height: 46px;
    padding: 10px 12px;
    width: 100%;
}

.auth-field input:focus,
.auth-field select:focus {
    border-color: #1f6f5b;
    box-shadow: 0 0 0 3px rgba(31, 111, 91, 0.16);
    outline: none;
}

.auth-submit {
    background: #143b32;
    border: 0;
    border-radius: 8px;
    color: #fff;
    font-weight: 700;
    min-height: 46px;
    padding: 10px 20px;
    width: 100%;
}

.auth-submit:hover {
    background: #1f6f5b;
}

.auth-switch {
    color: #1f6f5b;
    border: 0;
    background: transparent;
    font-weight: 700;
    padding: 0;
}

.text-danger {
    display: block;
    font-size: 13px;
    margin-top: 6px;
}

@media (max-width: 768px) {
    .auth-form-grid {
        grid-template-columns: 1fr;
        gap: 0;
    }
}
</style>

<div class="background" >
</div>

<main>
<br><br><br>
<div class="slider-container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title">Carousel with captions</h3> --}}
            </div>
            <div class="card-body">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000" data-pause="hover" data-keyboard="true">
  <div class="carousel-inner overlay-gradient">
    @forelse($sliders as $key => $slider)
    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
        @if(str_starts_with($slider->image_path, 'images/') || str_starts_with($slider->image_path, 'public/'))
            <img src="{{ asset($slider->image_path) }}" class="d-block w-100" alt="Slider">
        @else
            <img src="{{ asset('storage/' . $slider->image_path) }}" class="d-block w-100" alt="Slider">
        @endif
      <div class="carousel-caption d-none d-md-block">
        <p>{{ $slider->caption }}</p>
      </div>
    </div>
    @empty
    <div class="carousel-item active">
      <div class="alert alert-info text-center p-5">
        <p>No sliders configured. <a href="{{ route('admin.sliders.index') }}">Add sliders now</a></p>
      </div>
    </div>
    @endforelse
  </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced smooth carousel transitions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carouselExampleCaptions');
    if (carousel) {
        const bsCarousel = window.bootstrap && bootstrap.Carousel
            ? new bootstrap.Carousel(carousel, {
                interval: 4000,
                wrap: true,
                touch: true,
                pause: 'hover',
                keyboard: true
            })
            : null;

        if (!bsCarousel && window.jQuery) {
            $('#carouselExampleCaptions').carousel({
                interval: 4000,
                wrap: true,
                pause: 'hover',
                keyboard: true
            });
        }

        // Add smooth transition effects
        carousel.addEventListener('slide.bs.carousel', function (e) {
            const activeItem = carousel.querySelector('.carousel-item.active');
            const nextItem = e.relatedTarget;

            if (activeItem && nextItem) {
                activeItem.style.transition = 'transform 0.6s ease-in-out';
                nextItem.style.transition = 'transform 0.6s ease-in-out';
            }
        });

        // Enhanced touch/swipe support for mobile
        let startX = 0;
        let currentX = 0;
        let isDragging = false;

        carousel.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
            if (bsCarousel) {
                bsCarousel.pause();
            } else if (window.jQuery) {
                $('#carouselExampleCaptions').carousel('pause');
            }
        });

        carousel.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
        });

        carousel.addEventListener('touchend', function() {
            if (!isDragging) return;
            isDragging = false;

            const diffX = startX - currentX;
            const threshold = 50;

            if (diffX > threshold) {
                if (bsCarousel) {
                    bsCarousel.next();
                } else if (window.jQuery) {
                    $('#carouselExampleCaptions').carousel('next');
                }
            } else if (diffX < -threshold) {
                if (bsCarousel) {
                    bsCarousel.prev();
                } else if (window.jQuery) {
                    $('#carouselExampleCaptions').carousel('prev');
                }
            }

            if (bsCarousel) {
                bsCarousel.cycle();
            } else if (window.jQuery) {
                $('#carouselExampleCaptions').carousel('cycle');
            }
        });
    }
});
</script>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center g-4">
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card card-outline card-info shadow h-100">
                    <div class="service-item text-center pt-3">
                        <div class="p-4 text-center d-flex flex-column align-items-center">
                            <img src="{{ asset('images/bookIcon.jpeg') }}" style="height:60px; width:60px;" alt="Assignments">
                            <h5 class="mb-3">Assignments</h5>
                            <p class="text-center">Platform allows lectures to create assignments for students, and students can perform and submit their theory and practical assignments on the platform.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card card-outline card-info shadow h-100">
                    <div class="service-item text-center pt-3">
                        <div class="p-4 text-center d-flex flex-column align-items-center">
                            <img src="{{ asset('images/globe.jpeg') }}" style="height:60px; width:60px;" alt="Online Lectures">
                            <h5 class="mb-3">Online Lectures</h5>
                            <p class="text-center">Allows students to attend teachers from anywhere, and lecturers can conduct lectures for a large number of students from any location.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card card-outline card-info shadow h-100">
                    <div class="service-item text-center pt-3">
                        <div class="p-4 text-center d-flex flex-column align-items-center">
                            <img src="{{ asset('images/fileIcon.jpeg') }}" style="height:60px; width:60px;" alt="Quizzes">
                            <h5 class="mb-3">Quizzes</h5>
                            <p class="text-center">The platform enables teachers to upload quizzes, and allows students to take quizzes and submit them within a limited time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="home-actions">
        <button type="button" class="button" data-toggle="modal" data-target="#loginModal">Login</button>
        <button type="button" class="button" data-toggle="modal" data-target="#registerModal">Register</button>
    </div>

</div>

</main>

<div class="modal fade auth-modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="homeLoginForm">
                    @csrf
                    <input type="hidden" name="_auth_form" value="login">

                    <div class="auth-field">
                        <label for="login_email">Email Address</label>
                        <input type="email" name="email" id="login_email" value="{{ old('_auth_form') === 'login' ? old('email') : '' }}" required>
                        @if(old('_auth_form') === 'login')
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif
                    </div>

                    <div class="auth-field">
                        <label for="login_password">Password</label>
                        <input type="password" name="password" id="login_password" required>
                        @if(old('_auth_form') === 'login')
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif
                    </div>

                    <div class="auth-field d-flex align-items-center">
                        <input type="checkbox" id="remember" name="remember" style="width:18px;height:18px;margin-right:10px;">
                        <label for="remember" style="margin:0;">Remember me</label>
                    </div>

                    <button type="submit" class="auth-submit">Sign In</button>
                </form>

                <div class="text-center mt-3">
                    <span>Don't have an account?</span>
                    <button type="button" class="auth-switch" data-switch-auth="register">Create account</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade auth-modal" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Create Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('register') }}" id="homeRegisterForm">
                    @csrf
                    <input type="hidden" name="_auth_form" value="register">

                    <div class="auth-form-grid">
                        <div class="auth-field">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" value="{{ old('_auth_form') === 'register' ? old('firstname') : '' }}" required>
                            @if(old('_auth_form') === 'register') @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                        <div class="auth-field">
                            <label for="secondname">Second Name</label>
                            <input type="text" name="secondname" id="secondname" value="{{ old('_auth_form') === 'register' ? old('secondname') : '' }}" required>
                            @if(old('_auth_form') === 'register') @error('secondname') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                        <div class="auth-field">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" value="{{ old('_auth_form') === 'register' ? old('lastname') : '' }}" required>
                            @if(old('_auth_form') === 'register') @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                    </div>

                    <div class="auth-form-grid">
                        <div class="auth-field">
                            <label for="register_email">Email</label>
                            <input type="email" name="email" id="register_email" value="{{ old('_auth_form') === 'register' ? old('email') : '' }}" required>
                            @if(old('_auth_form') === 'register') @error('email') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                        <div class="auth-field">
                            <label for="register_password">Password</label>
                            <input type="password" name="password" id="register_password" required>
                            @if(old('_auth_form') === 'register') @error('password') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                        <div class="auth-field">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required>
                            @if(old('_auth_form') === 'register') @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                    </div>

                    <div class="auth-form-grid">
                        <div class="auth-field">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="male" @selected(old('_auth_form') === 'register' && old('gender') === 'male')>Male</option>
                                <option value="female" @selected(old('_auth_form') === 'register' && old('gender') === 'female')>Female</option>
                                <option value="other" @selected(old('_auth_form') === 'register' && old('gender') === 'other')>Other</option>
                            </select>
                            @if(old('_auth_form') === 'register') @error('gender') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                        <div class="auth-field">
                            <label for="school_id">School</label>
                            <select name="school_id" id="school_id" required>
                                <option value="" selected disabled>Select School</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" @selected(old('_auth_form') === 'register' && (string) old('school_id') === (string) $school->id)>{{ $school->name }}</option>
                                @endforeach
                            </select>
                            @if(old('_auth_form') === 'register') @error('school_id') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                        <div class="auth-field">
                            <label for="role">Role</label>
                            <select id="role" name="role" required>
                                <option value="" selected disabled>Select Role</option>
                                <option value="teacher" @selected(old('_auth_form') === 'register' && old('role') === 'teacher')>Teacher</option>
                                <option value="student" @selected(old('_auth_form') === 'register' && old('role') === 'student')>Student</option>
                            </select>
                            @if(old('_auth_form') === 'register') @error('role') <span class="text-danger">{{ $message }}</span> @enderror @endif
                        </div>
                    </div>

                    <div class="auth-field" id="classField">
                        <label for="class_id">Class</label>
                        <select id="class_id" name="class_id">
                            <option value="" selected disabled>Select Class</option>
                            @foreach($school_classes as $school_class)
                                <option value="{{ $school_class->id }}" @selected(old('_auth_form') === 'register' && (string) old('class_id') === (string) $school_class->id)>{{ $school_class->name }}</option>
                            @endforeach
                        </select>
                        @if(old('_auth_form') === 'register') @error('class_id') <span class="text-danger">{{ $message }}</span> @enderror @endif
                    </div>

                    <button type="submit" class="auth-submit">Create Account</button>
                </form>

                <div class="text-center mt-3">
                    <span>Already have an account?</span>
                    <button type="button" class="auth-switch" data-switch-auth="login">Sign in</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginModalElement = document.getElementById('loginModal');
    const registerModalElement = document.getElementById('registerModal');
    const roleSelect = document.getElementById('role');
    const classField = document.getElementById('classField');
    const classSelect = document.getElementById('class_id');

    function showModal(modalElement) {
        if (!modalElement) return;

        if (window.jQuery && typeof $(modalElement).modal === 'function') {
            $(modalElement).modal({
                backdrop: false,
                keyboard: true,
                show: true
            });
            $('.modal-backdrop').remove();
            return;
        }

        modalElement.classList.add('show');
        modalElement.style.display = 'block';
        modalElement.removeAttribute('aria-hidden');
        document.body.classList.add('modal-open');
    }

    function hideModal(modalElement) {
        if (!modalElement) return;

        if (window.jQuery && typeof $(modalElement).modal === 'function') {
            $(modalElement).modal('hide');
            return;
        }

        modalElement.classList.remove('show');
        modalElement.style.display = 'none';
        modalElement.setAttribute('aria-hidden', 'true');
    }

    function toggleClassField() {
        if (!roleSelect || !classField || !classSelect) return;

        if (roleSelect.value === 'student') {
            classField.style.display = 'block';
            classSelect.setAttribute('required', 'required');
        } else {
            classField.style.display = 'none';
            classSelect.removeAttribute('required');
            classSelect.value = '';
        }
    }

    if (roleSelect) {
        roleSelect.addEventListener('change', toggleClassField);
        toggleClassField();
    }

    document.querySelectorAll('[data-switch-auth]').forEach(function(button) {
        button.addEventListener('click', function() {
            if (button.dataset.switchAuth === 'register') {
                hideModal(loginModalElement);
                showModal(registerModalElement);
            } else {
                hideModal(registerModalElement);
                showModal(loginModalElement);
            }
        });
    });

    const authQuery = new URLSearchParams(window.location.search).get('auth');
    const oldForm = "{{ old('_auth_form') }}";

    if (authQuery === 'register' || oldForm === 'register') {
        showModal(registerModalElement);
    } else if (authQuery === 'login' || oldForm === 'login' || "{{ session('success') ? '1' : '' }}") {
        showModal(loginModalElement);
    }
});
</script>
