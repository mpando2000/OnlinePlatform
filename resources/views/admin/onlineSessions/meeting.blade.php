@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-video text-success mr-2"></i>
                        Administrative Session Created
                    </h1>
                    <p class="text-muted mb-0">Your session is ready - share access details and begin monitoring</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="session-status-badge admin-success">
                        <i class="fas fa-check-circle text-success mr-1 pulse"></i>
                        Session Active
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Session Card -->
                <div class="col-lg-8">
                    <div class="card main-session-card admin-theme">
                        <div class="card-header bg-gradient-success text-white text-center">
                            <div class="session-icon">
                                <i class="fas fa-shield-check"></i>
                            </div>
                            <h3 class="card-title mt-3">Administrative Session Ready</h3>
                            <p class="card-subtitle">Session created successfully with administrative privileges enabled</p>
                        </div>
                        <div class="card-body">
                            <!-- Session Details -->
                            <div class="session-details-section mb-4">
                                <h5 class="section-title">
                                    <i class="fas fa-info-circle text-info mr-2"></i>
                                    Session Information
                                </h5>
                                <div class="details-grid">
                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-link text-primary"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Meeting URL</label>
                                            <div class="detail-value">
                                                <a href="{{ $meeting->meeting_url }}" target="_blank" class="meeting-url" id="meetingUrl">
                                                    {{ $meeting->meeting_url }}
                                                </a>
                                                <button class="btn btn-sm btn-outline-primary ml-2" onclick="copyMeetingUrl()" title="Copy URL">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-item highlight">
                                        <div class="detail-icon">
                                            <i class="fas fa-key text-danger"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Session Code</label>
                                            <div class="detail-value">
                                                <span class="meeting-code" id="meetingCodeDisplay">{{ $meeting->meeting_code }}</span>
                                                <button class="btn btn-danger btn-sm ml-2" onclick="copyMeetingCode()" id="copyCodeBtn">
                                                    <i class="fas fa-copy mr-1"></i>
                                                    Copy Code
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Administrative Controls -->
                            <div class="admin-controls-section mb-4">
                                <h5 class="section-title">
                                    <i class="fas fa-cogs text-warning mr-2"></i>
                                    Administrative Controls
                                </h5>
                                <div class="control-buttons">
                                    <button class="btn btn-success btn-lg" onclick="joinMeeting()">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        Join as Administrator
                                    </button>
                                   
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Session Stats -->
                    <div class="card session-stats-card mb-4">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-line mr-2"></i>
                                Session Status
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="stat-item-horizontal">
                                <div class="stat-icon bg-success">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value" id="sessionDuration">00:00:00</div>
                                    <div class="stat-label">Session Duration</div>
                                </div>
                            </div>
                            
                            <div class="stat-item-horizontal">
                                <div class="stat-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value" id="participantCount">0</div>
                                    <div class="stat-label">Participants</div>
                                </div>
                            </div>
                            
                            <div class="stat-item-horizontal">
                                <div class="stat-icon bg-warning">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value">Admin</div>
                                    <div class="stat-label">Session Type</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Privileges -->
                    <div class="card privileges-card mb-4">
                        <div class="card-header bg-gradient-danger text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-crown mr-2"></i>
                                Your Privileges
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="privilege-list">
                                <div class="privilege-item">
                                    <i class="fas fa-shield-alt text-success mr-2"></i>
                                    <span>Full session control</span>
                                </div>
                                <div class="privilege-item">
                                    <i class="fas fa-microphone-slash text-info mr-2"></i>
                                    <span>Mute/unmute all participants</span>
                                </div>
                                <div class="privilege-item">
                                    <i class="fas fa-user-times text-warning mr-2"></i>
                                    <span>Remove disruptive users</span>
                                </div>
                                <div class="privilege-item">
                                    <i class="fas fa-record-vinyl text-danger mr-2"></i>
                                    <span>Start/stop recording</span>
                                </div>
                                <div class="privilege-item">
                                    <i class="fas fa-share-screen text-primary mr-2"></i>
                                    <span>Control screen sharing</span>
                                </div>
                                <div class="privilege-item">
                                    <i class="fas fa-comments text-secondary mr-2"></i>
                                    <span>Moderate chat messages</span>
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

<!-- Enhanced Admin Meeting Styles -->
<style>
    /* Admin Theme Variables */
    :root {
        --admin-primary: #dc3545;
        --admin-secondary: #6f42c1;
        --admin-success: #28a745;
        --admin-warning: #ffc107;
        --admin-info: #17a2b8;
        --admin-dark: #343a40;
        --admin-light: #f8f9fa;
    }

    .content-wrapper {
        background: #ffffff;
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: var(--admin-dark);
    }
    
    /* Status Badge */
    .session-status-badge.admin-success {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(23, 162, 184, 0.1) 100%);
        color: var(--admin-success);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        border: 2px solid rgba(40, 167, 69, 0.2);
        font-weight: 600;
    }
    
    .pulse {
        animation: pulse-success 2s ease-in-out infinite;
    }
    
    @keyframes pulse-success {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.05); }
    }
    
    /* Main Session Card */
    .main-session-card.admin-theme {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 40px rgba(40, 167, 69, 0.2);
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
        background: white;
        border: 2px solid rgba(40, 167, 69, 0.1);
    }
    
    .main-session-card.admin-theme .card-header {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, var(--admin-success), var(--admin-info));
        border-bottom: none;
        text-align: center;
        position: relative;
    }
    
    .main-session-card.admin-theme .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #17a2b8, #ffc107, #dc3545);
    }
    
    .session-icon {
        width: 90px;
        height: 90px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 2.5rem;
        animation: sessionIconFloat 3s ease-in-out infinite;
        border: 3px solid rgba(255,255,255,0.3);
    }
    
    @keyframes sessionIconFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(-5deg); }
    }
    
    .card-title {
        font-size: 2.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .card-subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }
    
    /* Section Titles */
    .section-title {
        font-weight: 600;
        color: var(--admin-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(40, 167, 69, 0.1);
    }
    
    /* Session Details */
    .session-details-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(40, 167, 69, 0.1);
    }
    
    .details-grid {
        display: grid;
        gap: 1.5rem;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .detail-item.highlight {
        border: 2px solid var(--admin-success);
        background: linear-gradient(135deg, #f0fff4 0%, #ffffff 100%);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.1);
    }
    
    .detail-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
    }
    
    .detail-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(40, 167, 69, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.2rem;
    }
    
    .detail-content {
        flex: 1;
    }
    
    .detail-content label {
        font-weight: 600;
        color: var(--admin-dark);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        display: block;
    }
    
    .detail-value {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .meeting-url {
        color: var(--admin-info);
        text-decoration: none;
        font-weight: 500;
        word-break: break-all;
    }
    
    .meeting-url:hover {
        text-decoration: underline;
    }
    
    .meeting-code {
        font-family: 'Courier New', monospace;
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--admin-success);
        background: rgba(40, 167, 69, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        letter-spacing: 1px;
    }
    
    /* Admin Controls */
    .admin-controls-section {
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(220, 53, 69, 0.1);
    }
    
    .control-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .control-buttons .btn {
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .control-buttons .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.6s ease;
    }
    
    .control-buttons .btn:hover::before {
        left: 100%;
    }
    
    .control-buttons .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    /* Quick Actions */
    .quick-actions-section {
        background: linear-gradient(135deg, #fff8e1 0%, #ffffff 100%);
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(255, 193, 7, 0.2);
    }
    
    .quick-action-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
        height: 100%;
    }
    
    .quick-action-card:hover {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border-color: rgba(255, 193, 7, 0.3);
    }
    
    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.5rem;
    }
    
    .action-content h6 {
        font-weight: 600;
        color: var(--admin-dark);
        margin-bottom: 0.5rem;
    }
    
    .action-content p {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }
    
    /* Sidebar Cards */
    .session-stats-card, .privileges-card, .settings-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.1);
        transition: all 0.3s ease;
        animation: fadeInRight 0.8s ease-out;
        background: white;
        border: 1px solid rgba(40, 167, 69, 0.1);
    }
    
    .session-stats-card:hover, .privileges-card:hover, .settings-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
    }
    
    /* Session Stats */
    .stat-item-horizontal {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(40, 167, 69, 0.1);
    }
    
    .stat-item-horizontal:last-child {
        border-bottom: none;
    }
    
    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.1rem;
    }
    
    .stat-info {
        flex: 1;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--admin-dark);
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    /* Privileges */
    .privilege-list {
        padding: 0;
    }
    
    .privilege-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
    }
    
    .privilege-item:last-child {
        border-bottom: none;
    }
    
    .privilege-item:hover {
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        transform: translateX(5px);
        margin: 0 -1rem;
        padding-left: 1rem;
        padding-right: 1rem;
        border-radius: 8px;
    }
    
    .privilege-item span {
        font-weight: 500;
        color: var(--admin-dark);
    }
    
    /* Settings */
    .setting-item {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(108, 117, 125, 0.1);
    }
    
    .setting-item:last-child {
        border-bottom: none;
    }
    
    .setting-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.25rem;
    }
    
    .setting-toggle input[type="checkbox"] {
        margin-right: 0.5rem;
        transform: scale(1.2);
    }
    
    .setting-toggle label {
        font-weight: 500;
        color: var(--admin-dark);
        cursor: pointer;
        flex: 1;
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
        font-size: 1rem;
        border-radius: 25px;
    }
    
    /* Card Headers */
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
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Copy button animations */
    .btn-copied {
        background-color: var(--admin-success) !important;
        border-color: var(--admin-success) !important;
    }
    
    .btn-copied i {
        animation: checkmark 0.6s ease-in-out;
    }
    
    @keyframes checkmark {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .main-session-card.admin-theme .card-header {
            padding: 2rem 1.5rem;
        }
        
        .session-icon {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }
        
        .card-title {
            font-size: 1.7rem;
        }
        
        .card-subtitle {
            font-size: 1rem;
        }
        
        .control-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        
        .control-buttons .btn {
            margin-bottom: 0.5rem;
            width: 100%;
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .detail-item {
            flex-direction: column;
            text-align: center;
        }
        
        .detail-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .meeting-code {
            font-size: 1rem;
        }
    }
    
    /* Loading Animation */
    .loading-spinner {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Success States */
    .success-glow {
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.4);
        animation: successPulse 1s ease-in-out;
    }
    
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>

<!-- Enhanced Admin Meeting Scripts -->
<script>
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    // Session start time for duration tracking
    let sessionStartTime = new Date();
    let durationInterval;
    let participantCount = 0;
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Admin Meeting page initialized');
        
        // Start duration counter
        startDurationCounter();
        
        // Initialize participant simulation
        simulateParticipantUpdates();
        
        // Add success glow to meeting code
        setTimeout(() => {
            document.querySelector('.detail-item.highlight').classList.add('success-glow');
        }, 1000);
        
        showAdminNotification('✅ Administrative session created successfully!', 'success');
        
    });
    
    // Duration counter
    function startDurationCounter() {
        durationInterval = setInterval(() => {
            const now = new Date();
            const diff = now - sessionStartTime;
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            const duration = 
                String(hours).padStart(2, '0') + ':' +
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0');
                
            document.getElementById('sessionDuration').textContent = duration;
        }, 1000);
    }
    
    // Simulate participant updates
    function simulateParticipantUpdates() {
        setInterval(() => {
            if (Math.random() > 0.7) { // 30% chance to update
                const change = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                participantCount = Math.max(0, participantCount + change);
                
                const countElement = document.getElementById('participantCount');
                countElement.style.transition = 'all 0.3s ease';
                countElement.style.transform = 'scale(1.1)';
                countElement.textContent = participantCount;
                
                setTimeout(() => {
                    countElement.style.transform = 'scale(1)';
                }, 300);
                
                if (change > 0) {
                    showAdminNotification(`👤 New participant joined (${participantCount} total)`, 'info');
                } else if (change < 0 && participantCount >= 0) {
                    showAdminNotification(`👋 Participant left (${participantCount} total)`, 'warning');
                }
            }
        }, 8000); // Check every 8 seconds
    }
    
    // Copy meeting code function
    function copyMeetingCode() {
        const meetingCode = document.getElementById('meetingCodeDisplay').textContent;
        const copyBtn = document.getElementById('copyCodeBtn');
        
        navigator.clipboard.writeText(meetingCode).then(() => {
            // Success feedback
            const originalContent = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
            copyBtn.classList.add('btn-copied');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalContent;
                copyBtn.classList.remove('btn-copied');
            }, 2000);
            
            showAdminNotification('📋 Session code copied: ' + meetingCode, 'success');
            
        }).catch(() => {
            // Fallback for older browsers
            const tempInput = document.createElement('textarea');
            tempInput.value = meetingCode;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            
            showAdminNotification('📋 Session code copied: ' + meetingCode, 'success');
        });
    }
    
    // Copy meeting URL function
    function copyMeetingUrl() {
        const meetingUrl = document.getElementById('meetingUrl').href;
        
        navigator.clipboard.writeText(meetingUrl).then(() => {
            showAdminNotification('🔗 Meeting URL copied to clipboard', 'success');
        }).catch(() => {
            // Fallback
            const tempInput = document.createElement('textarea');
            tempInput.value = meetingUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            
            showAdminNotification('🔗 Meeting URL copied to clipboard', 'success');
        });
    }
    
    // Admin control functions
    function joinMeeting() {
        showAdminNotification('🚀 Joining session as Administrator...', 'info');
        
        setTimeout(() => {
            const meetingUrl = document.getElementById('meetingUrl').href;
            window.open(meetingUrl, '_blank');
            showAdminNotification('✅ Session opened in new tab', 'success');
        }, 1000);
    }
    
    function openMonitoringPanel() {
        showAdminNotification('📊 Opening administrative monitoring panel...', 'info');
        
        setTimeout(() => {
            showAdminNotification('🔍 Monitoring panel activated', 'success');
        }, 1000);
    }
    
    function shareSession() {
        showAdminNotification('📤 Opening share options...', 'info');
        
        // Simulate share dialog
        setTimeout(() => {
            const meetingCode = document.getElementById('meetingCodeDisplay').textContent;
            const shareText = `Join our administrative session!\nCode: ${meetingCode}\nURL: ${document.getElementById('meetingUrl').href}`;
            
            if (navigator.share) {
                navigator.share({
                    title: 'Administrative Session',
                    text: shareText
                });
            } else {
                // Copy to clipboard as fallback
                navigator.clipboard.writeText(shareText).then(() => {
                    showAdminNotification('📋 Session details copied for sharing', 'success');
                });
            }
        }, 500);
    }
    
    // Quick action functions
    function generateInviteEmail() {
        showAdminNotification('📧 Generating invitation email template...', 'info');
        
        setTimeout(() => {
            const meetingCode = document.getElementById('meetingCodeDisplay').textContent;
            const subject = 'Administrative Session Invitation';
            const body = `You are invited to join an administrative session.\n\nSession Code: ${meetingCode}\nMeeting URL: ${document.getElementById('meetingUrl').href}\n\nThis is an administrative session with special monitoring privileges.`;
            
            const mailtoLink = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            window.location.href = mailtoLink;
            
            showAdminNotification('📬 Email template opened', 'success');
        }, 1000);
    }
    
    function downloadSessionInfo() {
        showAdminNotification('💾 Generating session information PDF...', 'info');
        
        setTimeout(() => {
            showAdminNotification('📄 PDF generation complete (demo)', 'success');
        }, 2000);
    }
    
    function scheduleRecording() {
        showAdminNotification('🎬 Configuring automatic recording...', 'info');
        
        setTimeout(() => {
            showAdminNotification('📹 Recording setup complete', 'success');
        }, 1500);
    }
    
    function saveSettings() {
        showAdminNotification('⚙️ Saving session settings...', 'info');
        
        setTimeout(() => {
            showAdminNotification('✅ Session settings updated successfully', 'success');
        }, 1000);
    }
    
    // Notification system
    function showAdminNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; max-width: 400px; animation: slideInRight 0.3s ease;';
        notification.innerHTML = `
            <strong><i class="fas fa-crown mr-1"></i>Admin:</strong> ${message}
            <button type="button" class="btn-close float-right" style="background: none; border: none; color: inherit; opacity: 0.7;" onclick="this.parentElement.remove()">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (document.body.contains(notification)) {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }
        }, 4000);
    }
    
    // Cleanup on page unload
    window.addEventListener('beforeunload', function() {
        if (durationInterval) {
            clearInterval(durationInterval);
        }
    });
    
    // Add slide animations for notifications
    const notificationStyles = document.createElement('style');
    notificationStyles.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(notificationStyles);
</script>

@endsection
