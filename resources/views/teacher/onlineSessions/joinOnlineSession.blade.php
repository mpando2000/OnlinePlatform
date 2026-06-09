@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-sign-in-alt text-primary mr-2"></i>
                        Join Online Session
                    </h1>
                    <p class="text-muted mb-0">Enter a meeting code to join an existing session as a teacher</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="teacher-status-badge">
                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                        Teacher Mode
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <!-- Main Join Card -->
                    <div class="card teacher-join-card">
                        <div class="card-header bg-gradient-success text-white text-center">
                            <div class="teacher-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3 class="mt-3 mb-1">Join as Teacher</h3>
                            <p class="mb-0">Enter the meeting code to join an existing session</p>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('teacher.joinMeeting') }}" method="POST">
                                @csrf
                                <div class="meeting-code-section">
                                    <label for="meeting_code" class="form-label h5 text-center d-block mb-3">
                                        <i class="fas fa-key text-success mr-2"></i>
                                        Enter Meeting Code
                                    </label>
                                    
                                    <div class="input-container">
                                        <input 
                                            type="text" 
                                            id="meeting_code"
                                            name="meeting_code" 
                                            class="form-control form-control-lg teacher-meeting-input" 
                                            placeholder="Enter meeting code here"
                                            required
                                            autocomplete="off"
                                        >
                                    </div>
                                    
                                    <div class="text-center mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Meeting code provided by session organizer
                                        </small>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg teacher-join-btn">
                                        <i class="fas fa-video mr-2"></i>
                                        Join Session Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Teacher Features -->
                    <div class="card mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-center">
                                <i class="fas fa-crown text-warning mr-2"></i>
                                Teacher Privileges
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="privilege-item">
                                        <div class="privilege-icon">
                                            <i class="fas fa-microphone"></i>
                                        </div>
                                        <div class="privilege-content">
                                            <strong>Audio Control</strong>
                                            <p class="mb-0">Manage participants' microphones</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="privilege-item">
                                        <div class="privilege-icon">
                                            <i class="fas fa-share-square"></i>
                                        </div>
                                        <div class="privilege-content">
                                            <strong>Screen Sharing</strong>
                                            <p class="mb-0">Share your screen with students</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="privilege-item">
                                        <div class="privilege-icon">
                                            <i class="fas fa-record-vinyl"></i>
                                        </div>
                                        <div class="privilege-content">
                                            <strong>Session Recording</strong>
                                            <p class="mb-0">Record sessions for later review</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="privilege-item">
                                        <div class="privilege-icon">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                        <div class="privilege-content">
                                            <strong>Manage Students</strong>
                                            <p class="mb-0">Control student participation</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-tools text-info mr-2"></i>
                                Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-success btn-block quick-action-btn" onclick="createNewSession()">
                                        <i class="fas fa-plus-circle d-block mb-2"></i>
                                        <small>Create New Session</small>
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-info btn-block quick-action-btn" onclick="viewSchedule()">
                                        <i class="fas fa-calendar-alt d-block mb-2"></i>
                                        <small>View Schedule</small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Session Guide -->
                    <div class="card session-guide-card">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Teaching Guide
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="guide-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h6>Prepare Materials</h6>
                                    <p class="text-muted mb-0">Have your teaching materials ready before joining</p>
                                </div>
                            </div>
                            <div class="guide-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h6>Test Equipment</h6>
                                    <p class="text-muted mb-0">Ensure your camera and microphone work properly</p>
                                </div>
                            </div>
                            <div class="guide-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h6>Join Session</h6>
                                    <p class="text-muted mb-0">Enter the meeting code and start teaching</p>
                                </div>
                            </div>
                            <div class="guide-step">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h6>Engage Students</h6>
                                    <p class="text-muted mb-0">Use interactive features to enhance learning</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Check -->
                    <div class="card mt-4">
                        <div class="card-header bg-gradient-warning text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-check-circle mr-2"></i>
                                System Status
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="system-item">
                                <div class="system-status">
                                    <i class="fas fa-wifi text-success"></i>
                                    <span class="status-text">Internet</span>
                                </div>
                                <div class="status-indicator good">Connected</div>
                            </div>
                            <div class="system-item">
                                <div class="system-status">
                                    <i class="fas fa-microphone text-success"></i>
                                    <span class="status-text">Microphone</span>
                                </div>
                                <div class="status-indicator good">Ready</div>
                            </div>
                            <div class="system-item">
                                <div class="system-status">
                                    <i class="fas fa-video text-success"></i>
                                    <span class="status-text">Camera</span>
                                </div>
                                <div class="status-indicator good">Ready</div>
                            </div>
                            <div class="system-item">
                                <div class="system-status">
                                    <i class="fas fa-volume-up text-success"></i>
                                    <span class="status-text">Speaker</span>
                                </div>
                                <div class="status-indicator good">Ready</div>
                            </div>
                        </div>
                    </div>

                    <!-- Support -->
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            <i class="fas fa-question-circle text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h5>Need Assistance?</h5>
                            <p class="text-muted">Technical support for teachers</p>
                            <div class="btn-group-vertical w-100">
                                <button class="btn btn-outline-primary btn-sm mb-2">
                                    <i class="fas fa-book mr-1"></i>Teaching Guide
                                </button>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-headset mr-1"></i>Tech Support
                                </button>
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

<!-- Enhanced Teacher Join Session Styles -->
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecf4 100%);
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    /* Teacher Status Badge */
    .teacher-status-badge {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        border: 1px solid rgba(40, 167, 69, 0.2);
        font-weight: 600;
    }
    
    /* Main Teacher Join Card */
    .teacher-join-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
    }
    
    .teacher-join-card .card-header {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #28a745, #1e7e34);
        border-bottom: none;
    }
    
    .teacher-icon {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 3rem;
        animation: teacherIconBounce 2s ease-in-out infinite;
    }
    
    @keyframes teacherIconBounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .teacher-join-card h3 {
        font-size: 2rem;
        font-weight: 600;
    }
    
    /* Meeting Code Section */
    .meeting-code-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 15px;
        border: 3px dashed #dee2e6;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }
    
    .meeting-code-section:focus-within {
        border-color: #28a745;
        background: #d4edda;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        transform: scale(1.02);
    }
    
    .teacher-meeting-input {
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
        padding: 1.5rem;
        border: none;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        letter-spacing: 1px;
    }
    
    .teacher-meeting-input:focus {
        border: 3px solid #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        transform: scale(1.05);
    }
    
    .teacher-meeting-input::placeholder {
        color: #adb5bd;
        font-weight: normal;
        letter-spacing: normal;
    }
    
    /* Teacher Join Button */
    .teacher-join-btn {
        font-size: 1.3rem;
        padding: 1rem 3rem;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        transition: all 0.3s ease;
        min-width: 250px;
    }
    
    .teacher-join-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }
    
    .teacher-join-btn:active {
        transform: translateY(-1px);
    }
    
    /* Privilege Items */
    .privilege-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .privilege-item:hover {
        background: #f8f9fa;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #28a745;
    }
    
    .privilege-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
        font-size: 1.2rem;
    }
    
    .privilege-content strong {
        color: #495057;
        font-weight: 600;
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .privilege-content p {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    /* Quick Actions */
    .quick-action-btn {
        border-radius: 15px;
        padding: 1rem;
        transition: all 0.3s ease;
        height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .quick-action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .quick-action-btn i {
        font-size: 1.5rem;
    }
    
    /* Session Guide */
    .session-guide-card .guide-step {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    
    .session-guide-card .guide-step:last-child {
        border-bottom: none;
    }
    
    .step-number {
        width: 35px;
        height: 35px;
        background: rgba(255,255,255,0.2);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .step-content h6 {
        color: white;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .step-content p {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }
    
    /* System Check */
    .system-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .system-item:last-child {
        border-bottom: none;
    }
    
    .system-status {
        display: flex;
        align-items: center;
    }
    
    .system-status i {
        margin-right: 0.5rem;
        width: 20px;
        text-align: center;
    }
    
    .status-text {
        font-weight: 500;
    }
    
    .status-indicator {
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-indicator.good {
        background: #d4edda;
        color: #155724;
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
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.3s; }
    .card:nth-child(3) { animation-delay: 0.5s; }
    .card:nth-child(4) { animation-delay: 0.7s; }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .content-header h1 {
            font-size: 2rem;
        }
        
        .teacher-icon {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }
        
        .teacher-join-card h3 {
            font-size: 1.5rem;
        }
        
        .teacher-meeting-input {
            font-size: 1.2rem;
            padding: 1rem;
        }
        
        .teacher-join-btn {
            font-size: 1.1rem;
            padding: 0.75rem 2rem;
            min-width: 200px;
        }
        
        .meeting-code-section {
            padding: 1.5rem;
        }
        
        .privilege-item {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }
        
        .privilege-icon {
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .quick-action-btn {
            height: auto;
            padding: 1rem;
        }
    }
    
    /* Special teacher-focused styling */
    .form-label {
        color: #495057;
        font-weight: 600;
    }
    
    /* Hover effects for better interactivity */
    .card-header:hover .teacher-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .privilege-item:hover .privilege-icon {
        transform: scale(1.1);
        background: linear-gradient(135deg, #34ce57, #28a745);
    }
</style>

<!-- Simple Scripts -->
<script>
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    // Simple teacher-focused functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on the meeting code input
        const meetingInput = document.getElementById('meeting_code');
        if (meetingInput) {
            setTimeout(() => meetingInput.focus(), 500);
        }
    });
    
    // Quick action functions
    function createNewSession() {
        window.location.href = "{{ route('teacher.createMeeting') }}";
    }
    
    function viewSchedule() {
        alert('Opening teacher schedule...');
        // Could redirect to teacher schedule page
    }
</script>
</script>

@endsection
