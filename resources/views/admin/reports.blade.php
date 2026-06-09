@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Admin Reports Page Styling */
.admin-reports-container {
    background: #f4f6f9;
    min-height: 100vh;
    padding: 0;
}

.reports-content {
    padding: 20px 0;
    position: relative;
}

.stats-overview {
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(45deg, #28a745, #20c997);
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 1.8rem;
    color: white;
}

.stat-icon.users { background: linear-gradient(45deg, #28a745, #20c997); }
.stat-icon.classes { background: linear-gradient(45deg, #007bff, #6610f2); }
.stat-icon.reports { background: linear-gradient(45deg, #ffc107, #fd7e14); }
.stat-icon.analytics { background: linear-gradient(45deg, #dc3545, #e83e8c); }

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-label {
    color: #6c757d;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.report-section {
    background: white;
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    border: none;
    position: relative;
    overflow: hidden;
}

.report-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #28a745, #20c997);
}

.section-header {
    margin-bottom: 30px;
    text-align: center;
}

.section-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.section-description {
    color: #6c757d;
    font-size: 1.1rem;
    line-height: 1.6;
}

.report-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.report-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 30px 25px;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.report-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(32, 201, 151, 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.report-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    border-color: #28a745;
}

.report-card:hover::before {
    opacity: 1;
}

.report-icon-wrapper {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
    color: white;
    position: relative;
    z-index: 2;
}

.report-icon-wrapper.primary { background: linear-gradient(45deg, #28a745, #20c997); }
.report-icon-wrapper.success { background: linear-gradient(45deg, #28a745, #20c997); }
.report-icon-wrapper.info { background: linear-gradient(45deg, #17a2b8, #007bff); }
.report-icon-wrapper.warning { background: linear-gradient(45deg, #ffc107, #fd7e14); }
.report-icon-wrapper.danger { background: linear-gradient(45deg, #dc3545, #e83e8c); }

.report-card h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
}

.report-card p {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 25px;
    position: relative;
    z-index: 2;
}

.report-btn {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    position: relative;
    z-index: 2;
    min-width: 160px;
    justify-content: center;
}

.report-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
}

.report-btn.btn-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.report-btn.btn-success:hover {
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

.report-btn.btn-info {
    background: linear-gradient(45deg, #17a2b8, #007bff);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.3);
}

.report-btn.btn-info:hover {
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.4);
}

.report-btn.btn-warning {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
    color: #2c3e50;
}

.report-btn.btn-warning:hover {
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
    color: #2c3e50;
}

.report-btn.btn-danger {
    background: linear-gradient(45deg, #dc3545, #e83e8c);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

.report-btn.btn-danger:hover {
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

/* Animation Classes */
.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animate-slideInLeft {
    animation: slideInLeft 0.8s ease-out forwards;
}

.animate-slideInRight {
    animation: slideInRight 0.8s ease-out forwards;
}

.animate-zoomIn {
    animation: zoomIn 0.6s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .report-section {
        padding: 25px 20px;
    }
    
    .section-title {
        font-size: 1.8rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .report-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .report-card {
        padding: 25px 20px;
    }
}
</style>

<div class="content-wrapper">
    <div class="admin-reports-container">
        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="reports-content">
            <div class="container">
                <!-- Statistics Overview -->
                <div class="stats-overview animate-slideInLeft">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="stat-icon users">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-number">{{ App\Models\User::count() ?? '0' }}</div>
                                <div class="stat-label">Total Users</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="stat-icon classes">
                                    <i class="fas fa-chalkboard"></i>
                                </div>
                                <div class="stat-number">{{ App\Models\SchoolClass::count() ?? '0' }}</div>
                                <div class="stat-label">Active Classes</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="stat-icon reports">
                                    <i class="fas fa-file-chart-column"></i>
                                </div>
                                <div class="stat-number">4</div>
                                <div class="stat-label">Report Types</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-card">
                                <div class="stat-icon analytics">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="stat-number">{{ date('Y') }}</div>
                                <div class="stat-label">Current Year</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Data Reports -->
                <div class="report-section animate-slideInRight">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-database"></i>
                            System Data Reports
                        </h2>
                        <p class="section-description">
                            Access comprehensive reports on user registrations, class management, and system data analytics
                        </p>
                    </div>
                    
                    <div class="report-grid">
                        <div class="report-card animate-zoomIn">
                            <div class="report-icon-wrapper success">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5>User Registry Report</h5>
                            <p>Complete user database with registration details, roles, and activity timestamps</p>
                            <a href="{{ route('admin.user.reports') }}" class="report-btn btn-success">
                                <i class="fas fa-eye"></i> View Report
                            </a>
                        </div>
                        
                        <div class="report-card animate-zoomIn" style="animation-delay: 0.1s;">
                            <div class="report-icon-wrapper info">
                                <i class="fas fa-chalkboard"></i>
                            </div>
                            <h5>Class Management Report</h5>
                            <p>Detailed class structures, student enrollment, and academic organization data</p>
                            <a href="{{ route('admin.class.reports') }}" class="report-btn btn-info">
                                <i class="fas fa-eye"></i> View Report
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Performance Analytics -->
                <div class="report-section animate-slideInLeft">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-chart-line"></i>
                            Performance Analytics
                        </h2>
                        <p class="section-description">
                            Monitor student performance, assessment results, and academic progress tracking
                        </p>
                    </div>
                    
                    <div class="report-grid">
                        <div class="report-card animate-zoomIn" style="animation-delay: 0.2s;">
                            <div class="report-icon-wrapper warning">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h5>Assessment Analytics</h5>
                            <p>Comprehensive assessment results, quiz performance, and learning outcome metrics</p>
                            <a href="#" class="report-btn btn-warning">
                                <i class="fas fa-chart-bar"></i> Coming Soon
                            </a>
                        </div>
                        
                        <div class="report-card animate-zoomIn" style="animation-delay: 0.3s;">
                            <div class="report-icon-wrapper danger">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h5>Submission Tracking</h5>
                            <p>Assignment submission rates, deadline compliance, and academic engagement analysis</p>
                            <a href="#" class="report-btn btn-danger">
                                <i class="fas fa-tasks"></i> Coming Soon
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<script>
$(document).ready(function() {
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced hover effects for report cards
    $('.report-card').hover(
        function() {
            $(this).find('.report-btn').css('transform', 'scale(1.05)');
        },
        function() {
            $(this).find('.report-btn').css('transform', 'scale(1)');
        }
    );

    // Stat cards counter animation
    $('.stat-number').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());
        
        if (countTo > 0) {
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        }
    });

    // Report button click effects
    $('.report-btn').on('click', function(e) {
        if ($(this).text().includes('Coming Soon')) {
            e.preventDefault();
            
            // Show coming soon message
            Swal.fire({
                title: 'Coming Soon!',
                text: 'This feature is under development and will be available soon.',
                icon: 'info',
                confirmButtonText: 'Got it!',
                confirmButtonColor: '#28a745',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        } else {
            // Add loading effect for active reports
            const originalText = $(this).html();
            $(this).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
            
            // Restore original text after a delay (the page will navigate anyway)
            setTimeout(() => {
                $(this).html(originalText);
            }, 1500);
        }
    });

    // Lazy load animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = '0s';
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all animated elements
    $('.animate-zoomIn').each(function() {
        this.style.animationPlayState = 'paused';
        observer.observe(this);
    });

    // Add ripple effect to buttons
    $('.report-btn').on('click', function(e) {
        const button = $(this);
        const ripple = $('<span class="ripple"></span>');
        
        button.append(ripple);
        
        const size = Math.max(button.outerWidth(), button.outerHeight());
        const x = e.pageX - button.offset().left - size / 2;
        const y = e.pageY - button.offset().top - size / 2;
        
        ripple.css({
            width: size,
            height: size,
            left: x,
            top: y
        }).addClass('animate');
        
        setTimeout(() => ripple.remove(), 600);
    });

    console.log('✅ Enhanced Admin Reports Dashboard initialized successfully!');
    console.log('📊 Statistics loaded and animations activated');
});

// Add ripple effect styles
const rippleStyle = `
<style>
.report-btn {
    position: relative;
    overflow: hidden;
}

.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(0);
    animation: none;
    pointer-events: none;
}

.ripple.animate {
    animation: rippleEffect 0.6s ease-out;
}

@keyframes rippleEffect {
    to {
        transform: scale(2);
        opacity: 0;
    }
}
</style>
`;
$('head').append(rippleStyle);
</script>
@endsection


