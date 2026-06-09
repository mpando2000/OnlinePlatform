@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h1 class="m-0">
                        <i class="fas fa-video text-primary mr-3"></i>
                        Join Online Session
                    </h1>
                    <p class="text-muted mb-0">Enter your meeting code to connect with your class</p>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <!-- Main Join Card -->
                    <div class="card join-meeting-card">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <div class="meeting-icon-large">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="mt-3 mb-1">Ready to Join?</h3>
                            <p class="mb-0">Connect instantly with your classmates and teachers</p>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('student.joinMeeting') }}" method="POST">
                                @csrf
                                <div class="meeting-input-section">
                                    <label for="meeting_code" class="form-label h5 text-center d-block mb-3">
                                        <i class="fas fa-key text-primary mr-2"></i>
                                        Enter Meeting Code
                                    </label>
                                    
                                    <div class="input-container">
                                        <input 
                                            type="text" 
                                            id="meeting_code"
                                            name="meeting_code" 
                                            class="form-control form-control-lg meeting-input" 
                                            placeholder="Enter meeting code here"
                                            required
                                            autocomplete="off"
                                        >
                                    </div>
                                    
                                    <div class="text-center mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Example: ABC123DEF or abc-123-def
                                        </small>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg btn-join-main">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        Join Meeting Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="card mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-center">
                                <i class="fas fa-lightbulb text-warning mr-2"></i>
                                Quick Tips
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="tip-item">
                                        <div class="tip-icon">
                                            <i class="fas fa-microphone-slash"></i>
                                        </div>
                                        <div class="tip-content">
                                            <strong>Stay Muted</strong>
                                            <p class="mb-0">Keep microphone muted when not speaking</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="tip-item">
                                        <div class="tip-icon">
                                            <i class="fas fa-hand-paper"></i>
                                        </div>
                                        <div class="tip-content">
                                            <strong>Raise Hand</strong>
                                            <p class="mb-0">Use raise hand to ask questions</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="tip-item">
                                        <div class="tip-icon">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div class="tip-content">
                                            <strong>Use Chat</strong>
                                            <p class="mb-0">Type questions in chat window</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="tip-item">
                                        <div class="tip-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="tip-content">
                                            <strong>Be Punctual</strong>
                                            <p class="mb-0">Join meetings on time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Info -->
                   
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

<!-- Enhanced Join Meeting Styles -->
<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecf4 100%);
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
        font-size: 2.5rem;
    }
    
    .content-header .text-muted {
        font-size: 1.1rem;
    }
    
    /* Main Join Card */
    .join-meeting-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
    }
    
    .join-meeting-card .card-header {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-bottom: none;
    }
    
    .meeting-icon-large {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 3rem;
        animation: iconBounce 2s ease-in-out infinite;
    }
    
    @keyframes iconBounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .join-meeting-card h3 {
        font-size: 2rem;
        font-weight: 600;
    }
    
    /* Meeting Input Section */
    .meeting-input-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 15px;
        border: 3px dashed #dee2e6;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }
    
    .meeting-input-section:focus-within {
        border-color: #007bff;
        background: #e3f2fd;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        transform: scale(1.02);
    }
    
    .input-container {
        position: relative;
    }
    
    .meeting-input {
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
    
    .meeting-input:focus {
        border: 3px solid #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        transform: scale(1.05);
    }
    
    .meeting-input::placeholder {
        color: #adb5bd;
        font-weight: normal;
        letter-spacing: normal;
        text-transform: none;
    }
    
    /* Join Button */
    .btn-join-main {
        font-size: 1.3rem;
        padding: 1rem 3rem;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        transition: all 0.3s ease;
        min-width: 250px;
    }
    
    .btn-join-main:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }
    
    .btn-join-main:active {
        transform: translateY(-1px);
    }
    
    /* Tips Section */
    .tip-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .tip-item:hover {
        background: #f8f9fa;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .tip-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
        font-size: 1.2rem;
    }
    
    .tip-content strong {
        color: #495057;
        font-weight: 600;
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .tip-content p {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    /* Status Indicator */
    .status-indicator {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border-radius: 25px;
        font-weight: 600;
        border: 2px solid rgba(40, 167, 69, 0.2);
    }
    
    .status-indicator.online .fa-circle {
        animation: pulse-online 2s ease-in-out infinite;
    }
    
    @keyframes pulse-online {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
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
    
    /* Form enhancements */
    .form-label {
        color: #495057;
        font-weight: 600;
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .content-header h1 {
            font-size: 2rem;
        }
        
        .meeting-icon-large {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }
        
        .join-meeting-card h3 {
            font-size: 1.5rem;
        }
        
        .meeting-input {
            font-size: 1.2rem;
            padding: 1rem;
        }
        
        .btn-join-main {
            font-size: 1.1rem;
            padding: 0.75rem 2rem;
            min-width: 200px;
        }
        
        .meeting-input-section {
            padding: 1.5rem;
        }
        
        .tip-item {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }
        
        .tip-icon {
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
    }
    
    /* Focus enhancements */
    *:focus {
        outline: none;
    }
    
    .btn:focus,
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    /* Loading state for button (optional - only visual) */
    .btn-join-main:active {
        position: relative;
        opacity: 0.9;
    }
</style>

<!-- Simple Scripts - No interference with form submission -->
<script>
    // Footer year only
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    // Simple visual enhancements only - no form interference
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on the meeting code input for better UX
        const meetingInput = document.getElementById('meeting_code');
        if (meetingInput) {
            setTimeout(() => meetingInput.focus(), 500);
        }
        
        // No formatting - keep exactly what user types
    });
</script>
</script>

@endsection
