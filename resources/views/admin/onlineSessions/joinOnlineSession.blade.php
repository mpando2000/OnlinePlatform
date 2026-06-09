@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-eye text-success mr-2"></i>
                        Monitor Session
                    </h1>
                    <p class="text-muted mb-0">Enter session code to monitor or join ongoing sessions</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="admin-badge-header">
                        <i class="fas fa-shield-alt text-success mr-1"></i>
                        Admin Access
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Main Join Session Card -->
                    <div class="card main-join-card admin-theme">
                        <div class="card-header bg-gradient-success text-white text-center">
                            <div class="join-icon">
                                <i class="fas fa-search-plus"></i>
                            </div>
                            <h3 class="card-title mt-3">Session Monitoring Access</h3>
                            <p class="card-subtitle">Enter the session code to monitor or join as administrator</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.joinMeeting') }}" method="POST" id="joinSessionForm" class="admin-form">
                                @csrf
                                <div class="form-section">
                                    <div class="input-group-modern">
                                        <div class="input-icon">
                                            <i class="fas fa-key text-success"></i>
                                        </div>
                                        <div class="input-field-container">
                                            <input 
                                                type="text" 
                                                name="meeting_code" 
                                                id="meeting_code"
                                                class="form-control-modern" 
                                                placeholder=" "
                                                required
                                                maxlength="12"
                                                pattern="[A-Za-z0-9]{3,12}"
                                                autocomplete="off"
                                            >
                                            <label for="meeting_code" class="floating-label">Session Code</label>
                                            <div class="input-underline"></div>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Enter the session code provided by the teacher or from the active sessions list
                                    </small>
                                </div>

                                <div class="admin-privileges-notice mb-4">
                                    <div class="privilege-header">
                                        <i class="fas fa-crown text-warning mr-2"></i>
                                        <strong>Administrator Privileges</strong>
                                    </div>
                                    <div class="privilege-list">
                                        <div class="privilege-item">
                                            <i class="fas fa-eye text-success mr-2"></i>
                                            <span>Monitor all session activities</span>
                                        </div>
                                        <div class="privilege-item">
                                            <i class="fas fa-microphone-slash text-warning mr-2"></i>
                                            <span>Mute/unmute participants</span>
                                        </div>
                                        <div class="privilege-item">
                                            <i class="fas fa-ban text-success mr-2"></i>
                                            <span>Remove disruptive participants</span>
                                        </div>
                                        <div class="privilege-item">
                                            <i class="fas fa-record-vinyl text-info mr-2"></i>
                                            <span>Control session recording</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    
                                    <button type="submit" class="btn btn-success btn-lg" id="joinBtn">
                                        <i class="fas fa-search mr-2"></i>
                                        Monitor Session
                                    </button>
                                </div>
                            </form>
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

<!-- Enhanced Admin Join Session Styles -->
<style>
    /* Admin Theme Variables */
    :root {
        --admin-primary: #28a745;
        --admin-secondary: #20c997;
        --admin-warning: #ffc107;
        --admin-info: #17a2b8;
        --admin-success: #28a745;
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
    
    /* Admin Header Badge */
    .admin-badge-header {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(111, 66, 193, 0.1) 100%);
        color: var(--admin-primary);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        border: 2px solid rgba(220, 53, 69, 0.2);
        font-weight: 600;
        animation: adminGlow 3s ease-in-out infinite;
    }
    
    @keyframes adminGlow {
        0%, 100% { box-shadow: 0 0 5px rgba(220, 53, 69, 0.3); }
        50% { box-shadow: 0 0 20px rgba(220, 53, 69, 0.5); }
    }
    
    /* Main Join Card */
    .main-join-card.admin-theme {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 40px rgba(220, 53, 69, 0.2);
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
        background: white;
        border: 2px solid rgba(220, 53, 69, 0.1);
    }
    
    .main-join-card.admin-theme .card-header {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
        border-bottom: none;
        text-align: center;
        position: relative;
    }
    
    .main-join-card.admin-theme .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #20c997, #17a2b8, #6f42c1);
    }
    
    .join-icon {
        width: 90px;
        height: 90px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 2.5rem;
        animation: joinIconFloat 3s ease-in-out infinite;
        border: 3px solid rgba(255,255,255,0.3);
    }
    
    @keyframes joinIconFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
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
    
    /* Modern Form Styles */
    .admin-form {
        padding: 1rem;
    }
    
    .form-section {
        margin-bottom: 2rem;
    }
    
    .input-group-modern {
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 15px;
        padding: 1rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .input-group-modern:focus-within {
        border-color: var(--admin-primary);
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        background: white;
    }
    
    .input-icon {
        margin-right: 1rem;
        font-size: 1.2rem;
        width: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .input-field-container {
        flex: 1;
        position: relative;
    }
    
    .form-control-modern {
        width: 100%;
        border: none;
        background: transparent;
        font-size: 1.1rem;
        padding: 0.5rem 0;
        outline: none;
        color: var(--admin-dark);
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    .floating-label {
        position: absolute;
        left: 0;
        top: 0.5rem;
        color: #6c757d;
        font-size: 1rem;
        transition: all 0.3s ease;
        pointer-events: none;
        font-weight: 500;
    }
    
    .form-control-modern:focus + .floating-label,
    .form-control-modern:not(:placeholder-shown) + .floating-label {
        top: -1.2rem;
        font-size: 0.85rem;
        color: var(--admin-primary);
        font-weight: 600;
    }
    
    .input-underline {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--admin-primary), var(--admin-secondary));
        transition: width 0.3s ease;
    }
    
    .input-group-modern:focus-within .input-underline {
        width: 100%;
    }
    
    /* Admin Privileges Notice */
    .admin-privileges-notice {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border: 2px solid rgba(220, 53, 69, 0.1);
    }
    
    .privilege-header {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        color: var(--admin-dark);
    }
    
    .privilege-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 0.75rem;
    }
    
    .privilege-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        background: white;
        border-radius: 8px;
        border: 1px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
    }
    
    .privilege-item:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(220, 53, 69, 0.15);
        border-color: rgba(220, 53, 69, 0.3);
    }
    
    .privilege-item span {
        font-weight: 500;
        color: var(--admin-dark);
    }
    
    /* Form Actions */
    .form-actions {
        text-align: center;
        padding-top: 1rem;
    }
    
    .btn {
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.6s ease;
    }
    
    .btn:hover::before {
        left: 100%;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    
    .btn-lg {
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
    }
    
    .btn-success {
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
        border: none;
    }
    
    .btn-outline-secondary {
        border: 2px solid #6c757d;
        color: #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
    }
    
    /* Quick Access Card */
    .quick-access-card, .stats-card, .help-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
        animation: fadeInRight 0.8s ease-out;
        background: white;
        border: 1px solid rgba(220, 53, 69, 0.1);
    }
    
    .quick-access-card:hover, .stats-card:hover, .help-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.2);
    }
    
    .quick-action-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .quick-action-item:last-child {
        border-bottom: none;
    }
    
    .quick-action-item:hover {
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        transform: translateX(8px);
        border-radius: 8px;
        margin: 0 -1rem;
        padding: 1rem;
    }
    
    .action-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1rem;
    }
    
    .action-content {
        flex: 1;
    }
    
    .action-content h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
        color: var(--admin-dark);
    }
    
    .action-content p {
        font-size: 0.85rem;
        line-height: 1.3;
    }
    
    .action-arrow {
        color: #6c757d;
        transition: all 0.3s ease;
    }
    
    .quick-action-item:hover .action-arrow {
        color: var(--admin-primary);
        transform: translateX(5px);
    }
    
    /* Statistics */
    .stat-item {
        text-align: center;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(220, 53, 69, 0.1);
    }
    
    .stat-item:last-child {
        border-bottom: none;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    /* Modal Styles */
    .admin-modal .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 15px 40px rgba(220, 53, 69, 0.2);
    }
    
    .admin-modal .modal-header {
        border-radius: 15px 15px 0 0;
    }
    
    .session-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .session-item:last-child {
        border-bottom: none;
    }
    
    .session-item:hover {
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        transform: translateX(5px);
        border-radius: 8px;
        margin: 0 -1rem;
        padding: 1rem;
    }
    
    .session-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
    
    /* Loading Animation */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .main-join-card.admin-theme .card-header {
            padding: 2rem 1.5rem;
        }
        
        .join-icon {
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
        
        .input-group-modern {
            padding: 0.75rem;
        }
        
        .form-control-modern {
            font-size: 1rem;
        }
        
        .privilege-list {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .form-actions .btn {
            margin-bottom: 1rem;
            width: 100%;
        }
        
        .quick-action-item {
            flex-direction: column;
            text-align: center;
        }
        
        .action-icon {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
    
    /* Special Effects */
    .glow-effect {
        animation: glowPulse 2s ease-in-out infinite;
    }
    
    @keyframes glowPulse {
        0%, 100% { box-shadow: 0 0 5px rgba(220, 53, 69, 0.5); }
        50% { box-shadow: 0 0 20px rgba(220, 53, 69, 0.8); }
    }
    
    /* Focus indicators */
    .focus-visible {
        outline: 2px solid var(--admin-primary);
        outline-offset: 2px;
        border-radius: 4px;
    }
    
    /* Gradient backgrounds */
    .bg-gradient-success {
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary)) !important;
    }
</style>

<!-- Enhanced Admin Join Session Scripts -->
<script>
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Admin Join Session page initialized');
        
        const meetingCodeInput = document.getElementById('meeting_code');
        const joinBtn = document.getElementById('joinBtn');
        const form = document.getElementById('joinSessionForm');
        
        // Real-time validation and formatting
        meetingCodeInput.addEventListener('input', function() {
            let value = this.value.replace(/[^A-Za-z0-9]/g, '');
            this.value = value;
            
            // Enable/disable join button
            joinBtn.disabled = value.length < 3;
            
            // Add visual feedback
            const inputGroup = this.closest('.input-group-modern');
            if (value.length >= 3) {
                inputGroup.classList.add('glow-effect');
                joinBtn.classList.remove('btn-outline-success');
                joinBtn.classList.add('btn-success');
            } else {
                inputGroup.classList.remove('glow-effect');
                joinBtn.classList.add('btn-outline-success');
                joinBtn.classList.remove('btn-success');
            }
            
            // Remove formatting display - keep original case and format
            this.setAttribute('data-formatted', value);
        });
        
        // Form submission with loading state
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const code = meetingCodeInput.value.trim();
            if (code.length < 3) {
                showAdminNotification('Please enter a valid session code', 'warning');
                return;
            }
            
            // Show loading state
            joinBtn.classList.add('btn-loading');
            joinBtn.disabled = true;
            
            // Simulate validation and joining process
            setTimeout(() => {
                if (validateSessionCode(code)) {
                    showAdminNotification('✅ Session code validated successfully!', 'success');
                    showAdminNotification('🔗 Connecting to session...', 'info');
                    
                    // Add to recent sessions
                    addToRecentSessions(code);
                    
                    // Actually submit the form
                    setTimeout(() => {
                        showAdminNotification('🚀 Joining session as Administrator...', 'success');
                        this.submit();
                    }, 1000);
                } else {
                    joinBtn.classList.remove('btn-loading');
                    joinBtn.disabled = false;
                    showAdminNotification('❌ Invalid session code format. Please check and try again.', 'danger');
                }
            }, 800);
        });
        
        // Auto-focus on input
        meetingCodeInput.focus();
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'v':
                        // Paste and clean formatting
                        setTimeout(() => {
                            const event = new Event('input', { bubbles: true });
                            meetingCodeInput.dispatchEvent(event);
                        }, 10);
                        break;
                    case 'Enter':
                        e.preventDefault();
                        if (!joinBtn.disabled) {
                            form.dispatchEvent(new Event('submit'));
                        }
                        break;
                }
            }
        });
        
        // Load recent sessions on page load
        loadRecentSessions();
        loadSavedCodes();
        updateStats();
    });
    
    // Session code validation (mock)
    function validateSessionCode(code) {
        // More permissive validation - accept any code that looks like a valid session code
        if (code.length < 3) return false;
        
        // Accept any alphanumeric code of 3-12 characters (both uppercase and lowercase)
        const codePattern = /^[A-Za-z0-9]{3,12}$/;
        if (!codePattern.test(code)) return false;
        
        // For demo purposes, reject only obviously invalid codes (case insensitive)
        const invalidCodes = ['XXX', '000', 'INVALID', 'ERROR', 'xxx', 'invalid', 'error'];
        return !invalidCodes.includes(code.toUpperCase());
    }
    
    // Generate test code for demonstration
    function generateRandomCode() {
        const prefixes = ['MTH', 'PHY', 'CHE', 'BIO', 'ENG', 'HIS', 'ADMIN'];
        const grades = ['10', '11', '12'];
        const sections = ['A', 'B', 'C', '1', '2', '3'];
        
        const prefix = prefixes[Math.floor(Math.random() * prefixes.length)];
        
        let code;
        if (prefix === 'ADMIN') {
            // Generate admin-style code
            code = 'ADMIN' + Math.floor(Math.random() * 999).toString().padStart(3, '0');
        } else {
            // Generate subject-style code
            const grade = grades[Math.floor(Math.random() * grades.length)];
            const section = sections[Math.floor(Math.random() * sections.length)];
            code = prefix + grade + section;
        }
        
        document.getElementById('meeting_code').value = code;
        document.getElementById('meeting_code').dispatchEvent(new Event('input'));
        
        
    }
    
    // Recent sessions management
    function addToRecentSessions(code) {
        let recent = JSON.parse(localStorage.getItem('admin_recent_sessions') || '[]');
        recent = recent.filter(r => r.code !== code); // Remove if exists
        recent.unshift({
            code: code,
            timestamp: new Date().toISOString(),
            subject: getSubjectFromCode(code)
        });
        recent = recent.slice(0, 5); // Keep only 5 recent
        localStorage.setItem('admin_recent_sessions', JSON.stringify(recent));
    }
    
    function loadRecentSessions() {
        const recent = JSON.parse(localStorage.getItem('admin_recent_sessions') || '[]');
        // Update UI with recent sessions
        console.log('Recent sessions loaded:', recent);
    }
    
    function loadSavedCodes() {
        const saved = JSON.parse(localStorage.getItem('admin_saved_codes') || '[]');
        console.log('Saved codes loaded:', saved);
    }
    
    function getSubjectFromCode(code) {
        const subjectMap = {
            'MTH': 'Mathematics',
            'PHY': 'Physics',
            'CHE': 'Chemistry',
            'BIO': 'Biology',
            'ENG': 'English',
            'HIS': 'History'
        };
        const prefix = code.substring(0, 3);
        return subjectMap[prefix] || 'Unknown Subject';
    }
    
    
    
    function joinSessionWithCode(code) {
        document.getElementById('meeting_code').value = code;
        document.getElementById('meeting_code').dispatchEvent(new Event('input'));
        $('#activeSessionsModal').modal('hide');
        
        showAdminNotification('🎯 Code selected: ' + code, 'info');
        
        setTimeout(() => {
            document.getElementById('joinSessionForm').dispatchEvent(new Event('submit'));
        }, 500);
    }
    
    // Help functions
    function showMonitoringGuide() {
        showAdminNotification('Opening monitoring guide...', 'info');
    }
    
    function showTroubleshootingTips() {
        showAdminNotification('Loading troubleshooting tips...', 'info');
    }
    
    function contactTechSupport() {
        showAdminNotification('Connecting to technical support...', 'info');
    }
    
    // Statistics update
    function updateStats() {
        // Simulate real-time stats updates
        setInterval(() => {
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach((stat, index) => {
                if (Math.random() > 0.7) { // 30% chance to update
                    const current = parseInt(stat.textContent) || 0;
                    const change = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                    const newValue = Math.max(0, current + change);
                    
                    stat.style.transition = 'all 0.3s ease';
                    stat.style.transform = 'scale(1.1)';
                    
                    if (index === 2) { // Time stat
                        stat.textContent = newValue + 'h';
                    } else {
                        stat.textContent = newValue;
                    }
                    
                    setTimeout(() => {
                        stat.style.transform = 'scale(1)';
                    }, 300);
                }
            });
        }, 15000); // Update every 15 seconds
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