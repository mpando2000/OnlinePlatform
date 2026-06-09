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
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
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
    border-radius: 20px;
    overflow: hidden;
    margin: 0 auto;
}

.carousel-inner {
    border-radius: 20px;
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
    border-radius: 20px;
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
    background: rgba(40, 167, 69, 0.9);
    border: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    z-index: 10;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
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
    background: rgba(40, 167, 69, 1);
    border-color: #fff;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 12px 35px rgba(40, 167, 69, 0.6);
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
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 100%);
    bottom: 0;
    left: 0;
    right: 0;
    padding: 40px 30px 25px;
    border-radius: 0 0 20px 20px;
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

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        margin: 0 4px;
    }
}

/* Service cards styling improvements */
.service-item img {
    border-radius: 50%;
    padding: 8px;
    background: linear-gradient(135deg, #28a745, #20c997);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

.service-item:hover img {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
}

.service-item h5 {
    color: #28a745;
    font-weight: 700;
    margin-top: 1rem;
}

.service-item p {
    color: #666;
    line-height: 1.6;
}

.card.shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(40, 167, 69, 0.15) !important;
}

/* Button styling */
.button {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
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
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="hover" data-bs-keyboard="true">
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
        // Initialize Bootstrap carousel with custom options
        const bsCarousel = new bootstrap.Carousel(carousel, {
            interval: 4000,
            wrap: true,
            touch: true,
            pause: 'hover',
            keyboard: true
        });

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
            bsCarousel.pause();
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
                bsCarousel.next();
            } else if (diffX < -threshold) {
                bsCarousel.prev();
            }

            bsCarousel.cycle();
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


    <div class="ml-6">
    <form id="roleForm" action="{{ route('loginForm') }}" method="GET" style="display: inline-block;">
        @csrf
        <button type="button" onclick="setFormAction('login')" class="button" style="margin: 20px">Login</button>
        <button type="button" onclick="setFormAction('register')" class="button">Register</button>
    </form>
</div>

<script>
    function setFormAction(action) {
        const form = document.getElementById('roleForm');

        if (action === 'login') {
            form.action = "{{ route('loginForm') }}";  // Route to login form
        } else if (action === 'register') {
            form.action = "{{ route('regForm') }}";  // Route to registration form
        }

        form.submit(); // Submit the form
    }
</script>

</div>

</main>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
