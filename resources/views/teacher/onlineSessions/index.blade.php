


@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-chalkboard-teacher text-primary mr-2"></i>
                        Online Sessions
                    </h1>
                    <p class="text-muted mb-0">Manage and conduct online tutoring sessions</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="session-status-badge">
                        <i class="fas fa-circle text-success mr-1"></i>
                        Ready to Start
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
                <!-- Main Actions Card -->
                <div class="col-lg-8">
                    <div class="card main-actions-card">
                        <div class="card-header bg-gradient-primary text-white">
                            <div class="card-icon">
                                <i class="fas fa-video"></i>
                            </div>
                            <h3 class="card-title mt-3">Online Session Management</h3>
                            <p class="card-subtitle">Create or join online tutoring sessions with your students</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Create Session -->
                                <div class="col-md-6 mb-4">
                                    <div class="action-card create-session">
                                        <div class="action-icon">
                                            <i class="fas fa-plus-circle"></i>
                                        </div>
                                        <div class="action-content">
                                            <h5>Create New Session</h5>
                                            <p class="text-muted">Start a new online tutoring session and invite students</p>
                                            <a href="{{ route('teacher.createMeeting') }}" class="btn btn-success btn-lg">
                                                <i class="fas fa-video mr-2"></i>
                                                Create Session
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Join Session -->
                                <div class="col-md-6 mb-4">
                                    <div class="action-card join-session">
                                        <div class="action-icon">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </div>
                                        <div class="action-content">
                                            <h5>Join Existing Session</h5>
                                            <p class="text-muted">Enter a meeting code to join an ongoing session</p>
                                            <a href="{{ route('teacher.joinOnlineSessions') }}" class="btn btn-primary btn-lg">
                                                <i class="fas fa-keyboard mr-2"></i>
                                                Enter Code
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Features -->
                            <div class="features-section mt-4">
                                <h6 class="mb-3">
                                    <i class="fas fa-star text-warning mr-2"></i>
                                    Session Features
                                </h6>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item">
                                            <i class="fas fa-share-square text-info"></i>
                                            <span>Screen Share</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item">
                                            <i class="fas fa-comments text-success"></i>
                                            <span>Live Chat</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item">
                                            <i class="fas fa-record-vinyl text-danger"></i>
                                            <span>Recording</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item">
                                            <i class="fas fa-file-alt text-warning"></i>
                                            <span>Whiteboard</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Enhanced Teacher Online Sessions Styles -->
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecf4 100%);
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    /* Status Badge */
    .session-status-badge {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }
    
    .session-status-badge .fa-circle {
        animation: pulse-online 2s ease-in-out infinite;
    }
    
    @keyframes pulse-online {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    /* Info Boxes */
    .info-box {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .info-box-icon {
        border-radius: 15px 0 0 15px;
    }
    
    /* Main Actions Card */
    .main-actions-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
    }
    
    .main-actions-card .card-header {
        padding: 2.5rem 2rem;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-bottom: none;
        text-align: center;
    }
    
    .card-icon {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 2.5rem;
        animation: iconFloat 3s ease-in-out infinite;
    }
    
    @keyframes iconFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    .card-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .card-subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }
    
    /* Action Cards */
    .action-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }
    
    .action-card:hover {
        background: white;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .create-session:hover {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.05);
    }
    
    .join-session:hover {
        border-color: #007bff;
        background: rgba(0, 123, 255, 0.05);
    }
    
    .action-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        transition: all 0.3s ease;
    }
    
    .create-session:hover .action-icon {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        transform: scale(1.1);
    }
    
    .join-session:hover .action-icon {
        background: linear-gradient(135deg, #007bff, #0056b3);
        transform: scale(1.1);
    }
    
    .action-content h5 {
        font-weight: 600;
        color: #495057;
        margin-bottom: 1rem;
    }
    
    .action-content p {
        margin-bottom: 1.5rem;
    }
    
    /* Feature Items */
    .features-section {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        background: white;
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .feature-item i {
        margin-right: 0.5rem;
        width: 20px;
    }
    
    .feature-item span {
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    /* Upcoming Sessions */
    .upcoming-session {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .upcoming-session:last-child {
        border-bottom: none;
    }
    
    .upcoming-session:hover {
        background: #f8f9fa;
        transform: translateX(5px);
        margin-left: -1rem;
        margin-right: -1rem;
        padding-left: 1rem;
        padding-right: 1rem;
        border-radius: 8px;
    }
    
    .session-time {
        text-align: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .session-time .time {
        font-weight: bold;
        font-size: 1.1rem;
        color: #495057;
    }
    
    .session-time .date {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .session-details h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
        color: #495057;
    }
    
    .session-details p {
        font-size: 0.9rem;
    }
    
    /* Activity Items */
    .activity-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 0.9rem;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-content p {
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
    }
    
    /* Cards */
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    
    .card-header {
        border-radius: 15px 15px 0 0;
        font-weight: 600;
    }
    
    /* Buttons */
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 25px;
    }
    
    .btn-group-vertical .btn {
        border-radius: 8px !important;
        margin-bottom: 0.5rem;
    }
    
    /* Badges */
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        border-radius: 12px;
    }
    
    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
    
    /* Staggered animations */
    .info-box:nth-child(1) { animation-delay: 0.1s; }
    .info-box:nth-child(2) { animation-delay: 0.2s; }
    .info-box:nth-child(3) { animation-delay: 0.3s; }
    .info-box:nth-child(4) { animation-delay: 0.4s; }
    
    .card:nth-child(1) { animation-delay: 0.2s; }
    .card:nth-child(2) { animation-delay: 0.4s; }
    .card:nth-child(3) { animation-delay: 0.6s; }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .main-actions-card .card-header {
            padding: 2rem 1.5rem;
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        
        .card-title {
            font-size: 1.5rem;
        }
        
        .card-subtitle {
            font-size: 1rem;
        }
        
        .action-card {
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .action-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        
        .upcoming-session {
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        
        .session-time {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
    
    /* Hover effects for better interactivity */
    .card-header:hover .card-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .info-box-icon:hover {
        transform: scale(1.1);
    }
</style>

<!-- Simple Scripts -->
<script>
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    // Optional: Add some simple interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Add click animation to action cards
        const actionCards = document.querySelectorAll('.action-card');
        actionCards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('a')) {
                    const link = this.querySelector('a');
                    if (link) {
                        link.click();
                    }
                }
            });
        });
    });
</script>
</script>


@endsection















