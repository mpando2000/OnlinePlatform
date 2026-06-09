@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-crown text-success mr-2"></i>
                        Admin Online Sessions
                    </h1>
                    <p class="text-muted mb-0">Monitor, manage and oversee all online tutoring sessions</p>
                </div>
                
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
           

            <div class="row">
                <!-- Main Actions Card -->
                <div class="col-lg-8">
                    <div class="card main-actions-card admin-theme">
                        <div class="card-header bg-gradient-success text-white">
                            <div class="card-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <h3 class="card-title mt-3">Administrative Session Control</h3>
                            <p class="card-subtitle">Create, join, monitor and manage all online sessions across the platform</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Create Session -->
                                <div class="col-md-6 mb-4">
                                    <div class="action-card create-session admin-action">
                                        <div class="action-icon admin-create">
                                            <i class="fas fa-plus-circle"></i>
                                        </div>
                                        <div class="action-content">
                                            <h5>Create Admin Session</h5>
                                            <p class="text-muted">Start a new administrative session for monitoring or direct intervention</p>
                                            <a href="{{ route('admin.createMeeting') }}" class="btn btn-success btn-lg">
                                                <i class="fas fa-video mr-2"></i>
                                                Create Session
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Join Session -->
                                <div class="col-md-6 mb-4">
                                    <div class="action-card join-session admin-action">
                                        <div class="action-icon admin-join">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                        <div class="action-content">
                                            <h5>Monitor Session</h5>
                                            <p class="text-muted">Enter a meeting code to monitor or join an ongoing session</p>
                                            <a href="{{ route('admin.joinOnlineSessions') }}" class="btn btn-warning btn-lg">
                                                <i class="fas fa-search mr-2"></i>
                                                Monitor Session
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin Features -->
                            <div class="features-section admin-features mt-4">
                                <h6 class="mb-3">
                                    <i class="fas fa-shield-alt text-success mr-2"></i>
                                    Administrative Controls
                                </h6>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item admin-feature">
                                            <i class="fas fa-broadcast-tower text-success"></i>
                                            <span>Session Monitoring</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item admin-feature">
                                            <i class="fas fa-user-shield text-warning"></i>
                                            <span>User Management</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item admin-feature">
                                            <i class="fas fa-ban text-info"></i>
                                            <span>Session Control</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="feature-item admin-feature">
                                            <i class="fas fa-chart-line text-success"></i>
                                            <span>Analytics Dashboard</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- System Status -->
                            <div class="system-status mt-4 p-3">
                                <h6 class="mb-3">
                                    <i class="fas fa-server text-info mr-2"></i>
                                    System Status
                                </h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="status-item">
                                            <div class="status-indicator bg-success"></div>
                                            <span>Video Server: Online</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="status-item">
                                            <div class="status-indicator bg-success"></div>
                                            <span>Chat System: Active</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="status-item">
                                            <div class="status-indicator bg-warning"></div>
                                            <span>Storage: 78% Full</span>
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

<!-- Enhanced Admin Online Sessions Styles -->
<style>
    /* Admin Theme Colors */
    :root {
        --admin-primary: #28a745;
        --admin-secondary: #20c997;
        --admin-warning: #ffc107;
        --admin-info: #17a2b8;
        --admin-success: #28a745;
        --admin-dark: #343a40;
    }

    .content-wrapper {
        background: #ffffff;
        min-height: 100vh;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: var(--admin-dark);
    }
    
    /* Admin Status Badge */
    .session-status-badge.admin-badge {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
        color: var(--admin-primary);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        border: 2px solid rgba(40, 167, 69, 0.2);
        font-weight: 600;
    }
    
    .session-status-badge .fa-shield-alt {
        animation: pulse-admin 2s ease-in-out infinite;
    }
    
    @keyframes pulse-admin {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.05); }
    }
    
    /* Admin Info Boxes */
    .info-box.admin-info-box {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.15);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
        background: white;
        border-left: 4px solid var(--admin-primary);
    }
    
    .info-box.admin-info-box:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.25);
    }
    
    .info-box-icon {
        border-radius: 15px 0 0 15px;
    }
    
    /* Admin Main Actions Card */
    .main-actions-card.admin-theme {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(40, 167, 69, 0.15);
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
        background: white;
        border: 2px solid rgba(40, 167, 69, 0.1);
    }
    
    .main-actions-card.admin-theme .card-header {
        padding: 2.5rem 2rem;
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
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
        animation: adminIconFloat 3s ease-in-out infinite;
        border: 3px solid rgba(255,255,255,0.3);
    }
    
    @keyframes adminIconFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-8px) rotate(5deg); }
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
    
    /* Admin Action Cards */
    .action-card.admin-action {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }
    
    .action-card.admin-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.1), transparent);
        transition: all 0.6s ease;
    }
    
    .action-card.admin-action:hover::before {
        left: 100%;
    }
    
    .action-card.admin-action:hover {
        background: linear-gradient(135deg, #ffffff 0%, #f5fff5 100%);
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(40, 167, 69, 0.2);
    }
    
    .create-session.admin-action:hover {
        border-color: var(--admin-primary);
    }
    
    .join-session.admin-action:hover {
        border-color: var(--admin-warning);
    }
    
    .action-icon.admin-create {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        transition: all 0.3s ease;
        border: 3px solid rgba(40, 167, 69, 0.2);
    }
    
    .action-icon.admin-join {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--admin-warning), #fd7e14);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        transition: all 0.3s ease;
        border: 3px solid rgba(255, 193, 7, 0.2);
    }
    
    .create-session.admin-action:hover .action-icon.admin-create {
        transform: scale(1.15) rotate(10deg);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }
    
    .join-session.admin-action:hover .action-icon.admin-join {
        transform: scale(1.15) rotate(-10deg);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
    }
    
    /* Admin Features */
    .features-section.admin-features {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(40, 167, 69, 0.1);
    }
    
    .feature-item.admin-feature {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        background: linear-gradient(135deg, #f5fff5 0%, #ffffff 100%);
        border-radius: 8px;
        transition: all 0.3s ease;
        border: 1px solid rgba(40, 167, 69, 0.1);
    }
    
    .feature-item.admin-feature:hover {
        background: linear-gradient(135deg, #ffffff 0%, #f5fff5 100%);
        transform: translateX(8px) scale(1.02);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.15);
        border-color: rgba(40, 167, 69, 0.3);
    }
    
    .feature-item.admin-feature i {
        margin-right: 0.75rem;
        width: 25px;
        font-size: 1.1rem;
    }
    
    .feature-item.admin-feature span {
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--admin-dark);
    }
    
    /* System Status */
    .system-status {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        border: 1px solid rgba(220, 53, 69, 0.1);
    }
    
    .status-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
        font-size: 0.9rem;
        color: var(--admin-dark);
        font-weight: 500;
    }
    
    .status-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 0.5rem;
        animation: pulse 2s infinite;
    }
    
    /* Admin Cards */
    .card.admin-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
        background: white;
        border: 1px solid rgba(220, 53, 69, 0.1);
    }
    
    .card.admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.2);
        border-color: rgba(220, 53, 69, 0.2);
    }
    
    .card-header {
        border-radius: 15px 15px 0 0;
        font-weight: 600;
    }
    
    /* Session Monitor Items */
    .session-monitor-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
    }
    
    .session-monitor-item:last-child {
        border-bottom: none;
    }
    
    .session-monitor-item:hover {
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        transform: translateX(5px);
        margin-left: -1rem;
        margin-right: -1rem;
        padding-left: 1rem;
        padding-right: 1rem;
        border-radius: 8px;
    }
    
    .session-status {
        display: flex;
        align-items: center;
        margin-right: 1rem;
        flex-direction: column;
        text-align: center;
    }
    
    .status-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-bottom: 0.25rem;
        animation: pulse 2s infinite;
    }
    
    .session-id {
        font-size: 0.75rem;
        font-weight: bold;
        color: var(--admin-dark);
    }
    
    .session-info {
        flex: 1;
    }
    
    .session-info h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
        color: var(--admin-dark);
    }
    
    .session-info p {
        font-size: 0.85rem;
    }
    
    .participants .badge {
        font-size: 0.7rem;
        margin-right: 0.25rem;
    }
    
    .monitor-actions {
        margin-left: 0.5rem;
    }
    
    /* Analytics Items */
    .analytics-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(220, 53, 69, 0.1);
    }
    
    .analytics-item:last-child {
        border-bottom: none;
    }
    
    .analytics-icon {
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
    
    .analytics-content {
        flex: 1;
    }
    
    .analytics-content p {
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        color: var(--admin-dark);
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
    
    .btn-success {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, var(--admin-warning), #fd7e14);
        border: none;
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
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    /* Staggered animations */
    .info-box.admin-info-box:nth-child(1) { animation-delay: 0.1s; }
    .info-box.admin-info-box:nth-child(2) { animation-delay: 0.2s; }
    .info-box.admin-info-box:nth-child(3) { animation-delay: 0.3s; }
    .info-box.admin-info-box:nth-child(4) { animation-delay: 0.4s; }
    
    .card.admin-card:nth-child(1) { animation-delay: 0.2s; }
    .card.admin-card:nth-child(2) { animation-delay: 0.4s; }
    .card.admin-card:nth-child(3) { animation-delay: 0.6s; }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .main-actions-card.admin-theme .card-header {
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
        
        .action-card.admin-action {
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .action-icon.admin-create, .action-icon.admin-join {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        
        .session-monitor-item, .analytics-item {
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        
        .session-status, .analytics-icon {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
    
    /* Hover effects for better interactivity */
    .card-header:hover .card-icon {
        transform: scale(1.1) rotate(10deg);
        background: rgba(255,255,255,0.3);
    }
    
    .info-box-icon:hover {
        transform: scale(1.1);
    }
    
    /* Admin-specific gradients */
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #20c997) !important;
    }
    
    /* Special admin effects */
    .admin-glow {
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.3);
    }
    
    .admin-border {
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 10px;
    }
    
    /* Loading states */
    .loading-admin {
        position: relative;
        overflow: hidden;
    }
    
    .loading-admin::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(220, 53, 69, 0.1), transparent);
        animation: adminLoading 2s infinite;
    }
    
    @keyframes adminLoading {
        0% { left: -100%; }
        100% { left: 100%; }
    }
</style>

<!-- Enhanced Admin Scripts -->
<script>
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Admin Online Sessions initialized');
        
        // Add click animation to action cards
        const actionCards = document.querySelectorAll('.action-card.admin-action');
        actionCards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('a')) {
                    const link = this.querySelector('a');
                    if (link) {
                        link.click();
                    }
                }
            });
            
            // Add ripple effect
            card.addEventListener('mousedown', function(e) {
                const ripple = document.createElement('div');
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(220, 53, 69, 0.3);
                    transform: scale(0);
                    animation: adminRipple 0.6s linear;
                    pointer-events: none;
                `;
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Monitor session status updates (simulation)
        setInterval(function() {
            const statusDots = document.querySelectorAll('.status-dot');
            statusDots.forEach(dot => {
                // Add subtle animation variation
                const currentClass = dot.className;
                dot.style.animation = 'none';
                setTimeout(() => {
                    dot.style.animation = '';
                }, 10);
            });
        }, 5000);
        
        // System status monitoring
        const systemStatus = document.querySelectorAll('.status-indicator');
        systemStatus.forEach(indicator => {
            indicator.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.2)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            indicator.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
        });
        
        // Admin privilege notifications
        function showAdminNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; max-width: 350px;';
            notification.innerHTML = `
                <strong><i class="fas fa-crown mr-1"></i>Admin:</strong> ${message}
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
        
        // Monitor buttons functionality
        const monitorButtons = document.querySelectorAll('.monitor-actions .btn');
        monitorButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const sessionId = this.closest('.session-monitor-item').querySelector('.session-id').textContent;
                
                if (this.classList.contains('btn-outline-warning')) {
                    showAdminNotification(`Investigating issues in session ${sessionId}`, 'warning');
                } else {
                    showAdminNotification(`Monitoring session ${sessionId}`, 'info');
                }
            });
        });
        
        // System control buttons
        const systemButtons = document.querySelectorAll('.btn-group-vertical .btn');
        systemButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.textContent.trim();
                
                if (action.includes('Emergency')) {
                    if (confirm('Are you sure you want to initiate emergency stop? This will affect all active sessions.')) {
                        showAdminNotification('Emergency stop initiated - all sessions will be safely terminated', 'warning');
                    }
                } else if (action.includes('Broadcasting')) {
                    showAdminNotification('Session broadcasting panel opened', 'info');
                } else if (action.includes('Export')) {
                    showAdminNotification('Generating admin reports...', 'success');
                } else {
                    showAdminNotification(`${action} accessed`, 'info');
                }
            });
        });
        
        // Add subtle parallax effect to header
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.content-header');
            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.1}px)`;
            }
        });
        
        // Real-time stats simulation
        setInterval(function() {
            const infoNumbers = document.querySelectorAll('.info-box-number');
            infoNumbers.forEach((number, index) => {
                const current = parseInt(number.textContent);
                const change = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                
                if (change !== 0) {
                    const newValue = Math.max(0, current + change);
                    number.style.transition = 'all 0.3s ease';
                    number.style.transform = 'scale(1.1)';
                    number.textContent = index === 3 ? newValue + 'h' : newValue;
                    
                    setTimeout(() => {
                        number.style.transform = 'scale(1)';
                    }, 300);
                }
            });
        }, 10000); // Update every 10 seconds
    });
    
    // Add CSS for ripple animation
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        @keyframes adminRipple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);
</script>


@endsection







