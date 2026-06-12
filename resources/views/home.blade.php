<x-layout>
@php
    $fallbackSlides = [
        ['src' => asset('images/jitegemee class.jpg'), 'caption' => 'Learn, submit, teach, and grow from one simple platform.'],
        ['src' => asset('images/slider1.jpeg'), 'caption' => 'A connected classroom experience for students and teachers.'],
        ['src' => asset('images/online.jpg'), 'caption' => 'Access learning activities wherever teaching happens.'],
    ];

    $heroSlides = $sliders->map(function ($slider) {
        $path = $slider->image_path;
        $src = str_starts_with($path, 'images/') || str_starts_with($path, 'public/')
            ? asset($path)
            : asset('storage/' . $path);

        return [
            'src' => $src,
            'caption' => $slider->caption ?: 'Next generation learning platform',
        ];
    })->values();

    if ($heroSlides->isEmpty()) {
        $heroSlides = collect($fallbackSlides);
    }
@endphp

<style>
    html {
        scroll-behavior: smooth;
    }

    body,
    .wrapper {
        background: #f5f7fb !important;
        color: #17212b;
        font-family: "Source Sans Pro", Arial, sans-serif;
    }

    .wrapper > .container {
        max-width: none;
        width: 100%;
        padding: 0;
    }

    .home-page {
        min-height: 100vh;
        background: #f5f7fb;
    }

    .home-hero {
        min-height: 86vh;
        position: relative;
        overflow: hidden;
        color: #fff;
        background: #09241f;
    }

    .hero-slider,
    .hero-slide {
        position: absolute;
        inset: 0;
    }

    .hero-slide {
        opacity: 0;
        transition: opacity 700ms ease;
    }

    .hero-slide.is-active {
        opacity: 1;
    }

    .hero-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: saturate(0.95);
    }

    .home-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(7, 28, 24, 0.92) 0%, rgba(7, 28, 24, 0.68) 44%, rgba(7, 28, 24, 0.28) 100%),
            linear-gradient(180deg, rgba(7, 28, 24, 0.18) 0%, rgba(7, 28, 24, 0.82) 100%);
        z-index: 1;
    }

    .home-nav,
    .hero-content,
    .hero-dots {
        position: relative;
        z-index: 2;
    }

    .home-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        max-width: 1180px;
        margin: 0 auto;
        padding: 22px 24px;
    }

    .brand-block {
        display: flex;
        align-items: center;
        min-width: 0;
        gap: 14px;
    }

    .brand-logo {
        width: 58px;
        height: 58px;
        object-fit: contain;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.92);
        padding: 4px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    .brand-title {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.1;
    }

    .brand-subtitle {
        margin: 4px 0 0;
        color: rgba(255, 255, 255, 0.78);
        font-size: 13px;
        font-weight: 700;
    }

    .nav-actions,
    .hero-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-home {
        border: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 800;
        min-height: 42px;
        padding: 11px 18px;
        text-decoration: none;
        transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
    }

    .btn-home:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }

    .btn-primary-home {
        background: #f4b41a;
        color: #09241f;
        box-shadow: 0 14px 30px rgba(244, 180, 26, 0.22);
    }

    .btn-primary-home:hover {
        background: #ffca45;
        color: #09241f;
    }

    .btn-outline-home {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.38);
    }

    .btn-outline-home:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .hero-content {
        display: grid;
        grid-template-columns: minmax(0, 0.92fr) minmax(300px, 0.48fr);
        gap: 34px;
        align-items: end;
        max-width: 1180px;
        margin: 0 auto;
        padding: 72px 24px 74px;
        min-height: calc(86vh - 112px);
    }

    .hero-copy {
        max-width: 760px;
    }

    .hero-kicker {
        color: #f4b41a;
        font-size: 13px;
        font-weight: 900;
        margin-bottom: 14px;
        text-transform: uppercase;
    }

    .hero-copy h1 {
        color: #fff;
        font-size: clamp(42px, 6vw, 78px);
        font-weight: 900;
        letter-spacing: 0;
        line-height: 0.95;
        margin: 0 0 22px;
    }

    .hero-copy p {
        color: rgba(255, 255, 255, 0.86);
        font-size: 19px;
        line-height: 1.55;
        margin: 0 0 28px;
        max-width: 650px;
    }

    .hero-caption {
        border-left: 4px solid #f4b41a;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 700;
        margin-top: 24px;
        min-height: 34px;
        padding-left: 14px;
    }

    .portal-card {
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(255, 255, 255, 0.52);
        border-radius: 8px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.22);
        color: #17212b;
        overflow: hidden;
    }

    .portal-card-header {
        background: #0f3d34;
        color: #fff;
        padding: 18px 20px;
    }

    .portal-card-header h2 {
        color: #fff;
        font-size: 19px;
        font-weight: 900;
        margin: 0;
    }

    .portal-card-body {
        padding: 18px;
    }

    .role-tabs {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
        margin-bottom: 16px;
    }

    .role-tab {
        background: #edf2f1;
        border: 1px solid #dce6e3;
        border-radius: 8px;
        color: #17352f;
        font-weight: 800;
        min-height: 42px;
        padding: 8px;
    }

    .role-tab.is-active {
        background: #0f3d34;
        border-color: #0f3d34;
        color: #fff;
    }

    .role-panel {
        display: none;
    }

    .role-panel.is-active {
        display: block;
    }

    .role-panel h3 {
        color: #0f3d34;
        font-size: 18px;
        font-weight: 900;
        margin: 0 0 8px;
    }

    .role-panel p {
        color: #53606c;
        font-size: 15px;
        line-height: 1.5;
        margin: 0 0 14px;
    }

    .role-list {
        display: grid;
        gap: 9px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .role-list li {
        align-items: center;
        color: #22313d;
        display: flex;
        gap: 9px;
        font-weight: 700;
    }

    .role-list i {
        color: #12866f;
    }

    .hero-dots {
        display: flex;
        gap: 8px;
        max-width: 1180px;
        margin: -54px auto 0;
        padding: 0 24px 28px;
    }

    .hero-dot {
        background: rgba(255, 255, 255, 0.34);
        border: 0;
        border-radius: 999px;
        height: 8px;
        width: 28px;
    }

    .hero-dot.is-active {
        background: #f4b41a;
    }

    .home-section {
        padding: 56px 24px;
    }

    .home-section-inner {
        max-width: 1180px;
        margin: 0 auto;
    }

    .section-head {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 22px;
    }

    .section-head h2 {
        color: #132922;
        font-size: 30px;
        font-weight: 900;
        margin: 0;
    }

    .section-head p {
        color: #5f6c77;
        margin: 7px 0 0;
        max-width: 620px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .feature-card {
        background: #fff;
        border: 1px solid #e1e8ee;
        border-radius: 8px;
        min-height: 220px;
        padding: 24px;
        box-shadow: 0 14px 34px rgba(18, 36, 51, 0.08);
        transition: transform 160ms ease, border-color 160ms ease;
    }

    .feature-card:hover {
        border-color: #b8cac5;
        transform: translateY(-3px);
    }

    .feature-icon {
        align-items: center;
        background: #e9f6f1;
        border-radius: 8px;
        color: #0f7a64;
        display: flex;
        font-size: 24px;
        height: 52px;
        justify-content: center;
        margin-bottom: 18px;
        width: 52px;
    }

    .feature-card h3 {
        color: #132922;
        font-size: 20px;
        font-weight: 900;
        margin: 0 0 10px;
    }

    .feature-card p {
        color: #596672;
        line-height: 1.6;
        margin: 0;
    }

    .info-band {
        background: #0f3d34;
        color: #fff;
        padding: 34px 24px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        max-width: 1180px;
        margin: 0 auto;
    }

    .info-item {
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 8px;
        padding: 20px;
    }

    .info-item h3 {
        color: #fff;
        font-size: 17px;
        font-weight: 900;
        margin: 0 0 12px;
    }

    .info-item p,
    .info-item a {
        color: rgba(255, 255, 255, 0.78);
        margin: 0;
    }

    .info-item a:hover {
        color: #f4b41a;
    }

    .home-footer {
        background: #09241f;
        color: rgba(255, 255, 255, 0.72);
        padding: 22px 24px;
        text-align: center;
    }

    @media (max-width: 991px) {
        .home-hero {
            min-height: auto;
        }

        .hero-content {
            grid-template-columns: 1fr;
            min-height: auto;
            padding-top: 48px;
        }

        .portal-card {
            max-width: 560px;
        }

        .feature-grid,
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .home-nav {
            align-items: flex-start;
            flex-direction: column;
        }

        .nav-actions {
            width: 100%;
        }

        .nav-actions .btn-home,
        .hero-actions .btn-home {
            flex: 1 1 140px;
        }

        .brand-logo {
            height: 48px;
            width: 48px;
        }

        .hero-copy h1 {
            font-size: 40px;
        }

        .hero-copy p {
            font-size: 17px;
        }

        .role-tabs {
            grid-template-columns: 1fr;
        }

        .section-head {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="home-page">
    <section class="home-hero">
        <div class="hero-slider" aria-hidden="true">
            @foreach($heroSlides as $index => $slide)
                <div class="hero-slide {{ $index === 0 ? 'is-active' : '' }}" data-hero-slide>
                    <img src="{{ $slide['src'] }}" alt="">
                </div>
            @endforeach
        </div>

        <nav class="home-nav" aria-label="Home navigation">
            <div class="brand-block">
                <img class="brand-logo" src="{{ asset('images/elimu.png') }}" alt="E-Learning logo">
                <div>
                    <p class="brand-title">E-Learning Management System</p>
                    <p class="brand-subtitle">Next Generation Learning Platform</p>
                </div>
            </div>

            <div class="nav-actions">
                <a href="{{ route('loginForm') }}" class="btn-home btn-outline-home">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('regForm') }}" class="btn-home btn-primary-home">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </div>
        </nav>

        <div class="hero-content">
            <div class="hero-copy">
                <div class="hero-kicker">Empowering learners for the future</div>
                <h1>Learning that feels connected.</h1>
                <p>Assignments, quizzes, online sessions, classes, and learning materials are brought together in one calm portal for students, teachers, and administrators.</p>
                <div class="hero-actions">
                    <a href="{{ route('loginForm') }}" class="btn-home btn-primary-home">
                        <i class="fas fa-unlock"></i> Start Learning
                    </a>
                    <a href="#features" class="btn-home btn-outline-home">
                        <i class="fas fa-layer-group"></i> Explore Features
                    </a>
                </div>
                <div class="hero-caption" id="heroCaption">{{ $heroSlides->first()['caption'] }}</div>
            </div>

            <aside class="portal-card" aria-label="Portal roles">
                <div class="portal-card-header">
                    <h2>Choose Your Portal</h2>
                </div>
                <div class="portal-card-body">
                    <div class="role-tabs" role="tablist" aria-label="Portal role tabs">
                        <button type="button" class="role-tab is-active" data-role-tab="student">Student</button>
                        <button type="button" class="role-tab" data-role-tab="teacher">Teacher</button>
                        <button type="button" class="role-tab" data-role-tab="admin">Admin</button>
                    </div>

                    <div class="role-panel is-active" data-role-panel="student">
                        <h3>Student Workspace</h3>
                        <p>Open lessons, view assignments, submit work, and take quizzes from one place.</p>
                        <ul class="role-list">
                            <li><i class="fas fa-check-circle"></i> Assignments and submissions</li>
                            <li><i class="fas fa-check-circle"></i> Class materials</li>
                            <li><i class="fas fa-check-circle"></i> Quiz access</li>
                        </ul>
                    </div>

                    <div class="role-panel" data-role-panel="teacher">
                        <h3>Teacher Workspace</h3>
                        <p>Create activities, share materials, review submissions, and manage quizzes.</p>
                        <ul class="role-list">
                            <li><i class="fas fa-check-circle"></i> Class and subject materials</li>
                            <li><i class="fas fa-check-circle"></i> Assignment marking</li>
                            <li><i class="fas fa-check-circle"></i> Quiz results</li>
                        </ul>
                    </div>

                    <div class="role-panel" data-role-panel="admin">
                        <h3>Admin Workspace</h3>
                        <p>Manage users, schools, classes, reports, and platform content with less clutter.</p>
                        <ul class="role-list">
                            <li><i class="fas fa-check-circle"></i> User approvals</li>
                            <li><i class="fas fa-check-circle"></i> Schools and classes</li>
                            <li><i class="fas fa-check-circle"></i> Reports overview</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>

        <div class="hero-dots" aria-label="Hero slides">
            @foreach($heroSlides as $index => $slide)
                <button type="button" class="hero-dot {{ $index === 0 ? 'is-active' : '' }}" data-hero-dot="{{ $index }}" aria-label="Show slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </section>

    <section class="home-section" id="features">
        <div class="home-section-inner">
            <div class="section-head">
                <div>
                    <h2>Everything for daily learning</h2>
                    <p>A lighter, clearer interface for the work students and teachers do most often.</p>
                </div>
                <a href="{{ route('regForm') }}" class="btn-home btn-primary-home">
                    <i class="fas fa-user-graduate"></i> Join Platform
                </a>
            </div>

            <div class="feature-grid">
                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-book-open"></i></div>
                    <h3>Assignments</h3>
                    <p>Teachers create tasks and students submit theory or practical work without moving between many pages.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-video"></i></div>
                    <h3>Online Lectures</h3>
                    <p>Live sessions and learning links stay organized so classes can continue from any location.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon"><i class="fas fa-clipboard-check"></i></div>
                    <h3>Quizzes</h3>
                    <p>Quiz uploads, attempts, results, and student progress remain simple to find and review.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="info-band">
        <div class="info-grid">
            <div class="info-item">
                <h3>Quick Links</h3>
                <p><a href="https://sumajkt.go.tz" target="_blank" rel="noopener">Visit Our Official Website</a></p>
            </div>
            <div class="info-item">
                <h3>Contact</h3>
                <p>+255 222 780 934<br>info@sumajkt.go.tz</p>
            </div>
            <div class="info-item">
                <h3>Location</h3>
                <p>Mlalakuwa, P.O. Box 1694<br>Dar-es-Salaam, Tanzania</p>
            </div>
        </div>
    </section>

    <footer class="home-footer">
        &copy; {{ date('Y') }} E-Learning Management System. All rights reserved.
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = Array.from(document.querySelectorAll('[data-hero-slide]'));
    const dots = Array.from(document.querySelectorAll('[data-hero-dot]'));
    const captions = @json($heroSlides->pluck('caption')->values());
    const captionElement = document.getElementById('heroCaption');
    let activeSlide = 0;
    let slideTimer = null;

    function showSlide(index) {
        if (!slides.length) return;

        activeSlide = (index + slides.length) % slides.length;

        slides.forEach(function(slide, slideIndex) {
            slide.classList.toggle('is-active', slideIndex === activeSlide);
        });

        dots.forEach(function(dot, dotIndex) {
            dot.classList.toggle('is-active', dotIndex === activeSlide);
        });

        if (captionElement && captions[activeSlide]) {
            captionElement.textContent = captions[activeSlide];
        }
    }

    function startSlider() {
        if (slides.length < 2) return;
        slideTimer = window.setInterval(function() {
            showSlide(activeSlide + 1);
        }, 5200);
    }

    dots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            window.clearInterval(slideTimer);
            showSlide(Number(dot.dataset.heroDot));
            startSlider();
        });
    });

    startSlider();

    document.querySelectorAll('[data-role-tab]').forEach(function(tab) {
        tab.addEventListener('click', function() {
            const role = tab.dataset.roleTab;

            document.querySelectorAll('[data-role-tab]').forEach(function(item) {
                item.classList.toggle('is-active', item === tab);
            });

            document.querySelectorAll('[data-role-panel]').forEach(function(panel) {
                panel.classList.toggle('is-active', panel.dataset.rolePanel === role);
            });
        });
    });

});
</script>
</x-layout>
