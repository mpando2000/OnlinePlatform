@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-video text-success mr-2"></i>
                        Meeting Created Successfully
                    </h1>
                    <p class="text-muted mb-0">Your online session is ready for students to join</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="meeting-status-badge">
                        <i class="fas fa-circle text-success mr-1 pulse"></i>
                        Meeting Active
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Meeting Info -->
                <div class="col-lg-8">
                    <!-- Meeting Details Card -->
                    <div class="card meeting-details-card">
                        <div class="card-header bg-gradient-success text-white">
                            <div class="meeting-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3 class="mt-3 mb-1">Meeting Ready to Start</h3>
                            <p class="mb-0">Share the details below with your students</p>
                        </div>
                        <div class="card-body">
                            <!-- Meeting URL Section -->
                            <div class="meeting-info-section mb-4">
                                <div class="info-header">
                                    <i class="fas fa-link text-primary mr-2"></i>
                                    <h5>Meeting URL</h5>
                                </div>
                                <div class="info-content">
                                    <div class="url-container">
                                        <input 
                                            type="text" 
                                            class="form-control url-input" 
                                            value="{{ $meeting->meeting_url }}" 
                                            readonly
                                            id="meetingUrl"
                                        >
                                        <button class="btn btn-outline-primary copy-btn" onclick="copyUrl()">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Students can click this link to join directly
                                    </small>
                                </div>
                            </div>

                            <!-- Meeting Code Section -->
                            <div class="meeting-info-section mb-4">
                                <div class="info-header">
                                    <i class="fas fa-key text-warning mr-2"></i>
                                    <h5>Meeting Code</h5>
                                </div>
                                <div class="info-content">
                                    <div class="code-display">
                                        <div class="meeting-code" id="meetingCode">
                                            {{ $meeting->meeting_code }}
                                        </div>
                                        <button class="btn btn-warning btn-lg copy-code-btn" onclick="copyMeetingCode()">
                                            <i class="fas fa-copy mr-2"></i>
                                            Copy Code
                                        </button>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Students can enter this code to join the meeting
                                    </small>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="quick-actions">
                                <h6 class="mb-3">
                                    <i class="fas fa-bolt text-info mr-2"></i>
                                    Quick Actions
                                </h6>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ $meeting->meeting_url }}" target="_blank" class="btn btn-success btn-block action-btn">
                                            <i class="fas fa-video mr-2"></i>
                                            Join Meeting
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-info btn-block action-btn" onclick="shareViaEmail()">
                                            <i class="fas fa-envelope mr-2"></i>
                                            Share via Email
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-secondary btn-block action-btn" onclick="generateQR()">
                                            <i class="fas fa-qrcode mr-2"></i>
                                            Generate QR
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Meeting Controls -->
                    <div class="card mt-4">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-sliders-h mr-2"></i>
                                Meeting Controls
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="control-item">
                                        <div class="control-icon bg-success">
                                            <i class="fas fa-microphone"></i>
                                        </div>
                                        <div class="control-content">
                                            <h6>Audio</h6>
                                            <small>Manage participant audio</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="control-item">
                                        <div class="control-icon bg-primary">
                                            <i class="fas fa-video"></i>
                                        </div>
                                        <div class="control-content">
                                            <h6>Video</h6>
                                            <small>Control video settings</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="control-item">
                                        <div class="control-icon bg-warning">
                                            <i class="fas fa-record-vinyl"></i>
                                        </div>
                                        <div class="control-content">
                                            <h6>Record</h6>
                                            <small>Record the session</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="control-item">
                                        <div class="control-icon bg-info">
                                            <i class="fas fa-share-square"></i>
                                        </div>
                                        <div class="control-content">
                                            <h6>Screen Share</h6>
                                            <small>Share your screen</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Meeting Information -->
                    <div class="card meeting-info-card">
                        <div class="card-header bg-gradient-dark text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle mr-2"></i>
                                Meeting Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <i class="fas fa-calendar text-primary mr-2"></i>
                                <div>
                                    <strong>Created</strong>
                                    <p class="mb-0 text-muted">{{ \Carbon\Carbon::now()->format('M d, Y \a\t H:i') }}</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock text-success mr-2"></i>
                                <div>
                                    <strong>Duration</strong>
                                    <p class="mb-0 text-muted">Unlimited</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-users text-info mr-2"></i>
                                <div>
                                    <strong>Participants</strong>
                                    <p class="mb-0 text-muted">No limit</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-shield-alt text-warning mr-2"></i>
                                <div>
                                    <strong>Security</strong>
                                    <p class="mb-0 text-muted">Password protected</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="card mt-4">
                        <div class="card-header bg-gradient-secondary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-list-ol mr-2"></i>
                                Instructions for Students
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="instruction-step">
                                <div class="step-number">1</div>
                                <div class="step-text">
                                    <strong>Get the meeting details</strong>
                                    <p>Share the meeting code or URL with students</p>
                                </div>
                            </div>
                            <div class="instruction-step">
                                <div class="step-number">2</div>
                                <div class="step-text">
                                    <strong>Join the session</strong>
                                    <p>Students can click the link or enter the code</p>
                                </div>
                            </div>
                            <div class="instruction-step">
                                <div class="step-number">3</div>
                                <div class="step-text">
                                    <strong>Start learning</strong>
                                    <p>Begin your interactive online session</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participants (Placeholder) -->
                    <div class="card mt-4">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-users mr-2"></i>
                                Participants <span class="badge badge-light ml-2">0</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-muted">
                                <i class="fas fa-user-plus mb-3" style="font-size: 2rem;"></i>
                                <p>No participants yet</p>
                                <small>Students will appear here when they join</small>
                            </div>
                        </div>
                    </div>

                    <!-- Support -->
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            <i class="fas fa-question-circle text-primary mb-3" style="font-size: 2rem;"></i>
                            <h6>Need Help?</h6>
                            <p class="text-muted mb-3">Having trouble with the meeting?</p>
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-headset mr-1"></i>Contact Support
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<style>
.meeting-details-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
}

.meeting-details-card .card-header {
    text-align: center;
    padding: 2rem;
    position: relative;
}

.meeting-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
}

.meeting-status-badge {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    font-weight: 500;
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.meeting-info-section {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 1.5rem;
    background: #f8f9fa;
}

.info-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.info-header h5 {
    margin: 0;
    font-weight: 600;
}

.url-container {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.url-input {
    border-radius: 8px;
    background: white;
    border: 2px solid #dee2e6;
}

.copy-btn {
    border-radius: 8px;
    padding: 0.375rem 1rem;
    border: 2px solid;
}

.code-display {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 10px;
}

.meeting-code {
    background: #007bff;
    color: white;
    padding: 1rem 2rem;
    border-radius: 10px;
    font-size: 1.5rem;
    font-weight: bold;
    letter-spacing: 2px;
    text-align: center;
    flex: 1;
    box-shadow: 0 4px 15px rgba(0,123,255,0.3);
}

.copy-code-btn {
    white-space: nowrap;
    box-shadow: 0 4px 15px rgba(255,193,7,0.3);
}

.quick-actions h6 {
    color: #495057;
    font-weight: 600;
}

.action-btn {
    border-radius: 8px;
    padding: 0.75rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.control-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.control-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.control-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    margin-right: 1rem;
}

.control-content h6 {
    margin: 0;
    font-weight: 600;
}

.control-content small {
    color: #6c757d;
}

.meeting-info-card {
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.info-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item i {
    margin-top: 2px;
    width: 20px;
}

.info-item div {
    flex: 1;
}

.info-item strong {
    color: #495057;
    display: block;
    margin-bottom: 0.25rem;
}

.instruction-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.step-number {
    width: 30px;
    height: 30px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 1rem;
    flex-shrink: 0;
}

.step-text strong {
    color: #495057;
    display: block;
    margin-bottom: 0.25rem;
}

.step-text p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 1.5rem;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

.bg-gradient-dark {
    background: linear-gradient(135deg, #343a40 0%, #6c757d 100%);
}

.bg-gradient-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #adb5bd 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
}

.toast-message {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #28a745;
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    z-index: 1050;
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.3s ease;
}

.toast-message.show {
    opacity: 1;
    transform: translateX(0);
}

.toast-message.error {
    background: #dc3545;
}

.toast-message.info {
    background: #17a2b8;
}
</style>

<script>
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-message ${type}`;
    
    let icon = 'fa-check-circle';
    if (type === 'error') icon = 'fa-exclamation-circle';
    if (type === 'info') icon = 'fa-info-circle';
    
    toast.innerHTML = `<i class="fas ${icon} mr-2"></i>${message}`;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 100);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 4000);
}

function copyMeetingCode() {
    const meetingCodeElement = document.getElementById("meetingCode");
    const meetingCode = meetingCodeElement.textContent.trim() || meetingCodeElement.innerText.trim();
    
    // Fallback method for older browsers or if clipboard API fails
    const fallbackCopy = (text) => {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            document.body.removeChild(textArea);
            return successful;
        } catch (err) {
            document.body.removeChild(textArea);
            return false;
        }
    };
    
    // Try modern clipboard API first
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(meetingCode).then(function() {
            showToast('Meeting code copied to clipboard!');
            updateCopyButton(true);
        }).catch(function(err) {
            console.warn('Clipboard API failed, trying fallback:', err);
            // Try fallback method
            if (fallbackCopy(meetingCode)) {
                showToast('Meeting code copied to clipboard!');
                updateCopyButton(true);
            } else {
                showToast('Failed to copy meeting code. Please copy manually.', 'error');
                updateCopyButton(false);
            }
        });
    } else {
        // Use fallback method directly
        if (fallbackCopy(meetingCode)) {
            showToast('Meeting code copied to clipboard!');
            updateCopyButton(true);
        } else {
            showToast('Failed to copy meeting code. Please copy manually.', 'error');
            updateCopyButton(false);
        }
    }
}

function updateCopyButton(success) {
    const button = event?.target?.closest('.copy-code-btn') || document.querySelector('.copy-code-btn');
    if (!button) return;
    
    const originalHTML = button.innerHTML;
    
    if (success) {
        button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
        button.classList.add('btn-success');
        button.classList.remove('btn-warning');
    } else {
        button.innerHTML = '<i class="fas fa-times mr-2"></i>Failed';
        button.classList.add('btn-danger');
        button.classList.remove('btn-warning');
    }
    
    setTimeout(function() {
        button.innerHTML = originalHTML;
        button.classList.remove('btn-success', 'btn-danger');
        button.classList.add('btn-warning');
    }, 2000);
}

function copyUrl() {
    const urlInput = document.getElementById("meetingUrl");
    const urlValue = urlInput.value;
    
    // Fallback copy function
    const fallbackCopy = (text) => {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            document.body.removeChild(textArea);
            return successful;
        } catch (err) {
            document.body.removeChild(textArea);
            return false;
        }
    };
    
    // Try modern clipboard API first
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(urlValue).then(function() {
            showToast('Meeting URL copied to clipboard!');
            updateUrlCopyButton(true);
        }).catch(function(err) {
            console.warn('Clipboard API failed, trying fallback:', err);
            // Try fallback method
            if (fallbackCopy(urlValue)) {
                showToast('Meeting URL copied to clipboard!');
                updateUrlCopyButton(true);
            } else {
                showToast('Failed to copy meeting URL. Please copy manually.', 'error');
                updateUrlCopyButton(false);
            }
        });
    } else {
        // Use fallback method directly
        urlInput.select();
        if (fallbackCopy(urlValue)) {
            showToast('Meeting URL copied to clipboard!');
            updateUrlCopyButton(true);
        } else {
            showToast('Failed to copy meeting URL. Please copy manually.', 'error');
            updateUrlCopyButton(false);
        }
    }
}

function updateUrlCopyButton(success) {
    const button = event?.target?.closest('.copy-btn') || document.querySelector('.copy-btn');
    if (!button) return;
    
    const originalHTML = button.innerHTML;
    
    if (success) {
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.add('btn-success');
        button.classList.remove('btn-outline-primary');
    } else {
        button.innerHTML = '<i class="fas fa-times"></i>';
        button.classList.add('btn-danger');
        button.classList.remove('btn-outline-primary');
    }
    
    setTimeout(function() {
        button.innerHTML = originalHTML;
        button.classList.remove('btn-success', 'btn-danger');
        button.classList.add('btn-outline-primary');
    }, 2000);
}

function shareViaEmail() {
    const meetingCode = document.getElementById("meetingCode").textContent.trim();
    const meetingUrl = document.getElementById("meetingUrl").value;
    
    const subject = encodeURIComponent("Join Our Online Class");
    const body = encodeURIComponent(`Hi,

You're invited to join our online class session.

Meeting Details:
- Meeting URL: ${meetingUrl}
- Meeting Code: ${meetingCode}

Instructions:
1. Click the meeting URL above to join directly
2. Or go to our online sessions page and enter the meeting code

See you in class!`);
    
    window.open(`mailto:?subject=${subject}&body=${body}`);
    showToast('Email client opened with meeting details');
}

function generateQR() {
    const meetingUrl = document.getElementById("meetingUrl").value;
    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(meetingUrl)}`;
    
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1060;
    `;
    
    modal.innerHTML = `
        <div style="background: white; padding: 2rem; border-radius: 15px; text-align: center; max-width: 400px;">
            <h5 class="mb-3">Meeting QR Code</h5>
            <img src="${qrUrl}" alt="Meeting QR Code" style="max-width: 100%; border-radius: 10px;">
            <p class="mt-3 text-muted">Students can scan this QR code to join the meeting</p>
            <button class="btn btn-secondary" onclick="this.parentElement.parentElement.remove()">Close</button>
        </div>
    `;
    
    document.body.appendChild(modal);
    modal.onclick = (e) => {
        if (e.target === modal) modal.remove();
    };
    
    showToast('QR code generated successfully');
}

// Add click handlers for control items
document.addEventListener('DOMContentLoaded', function() {
    const controlItems = document.querySelectorAll('.control-item');
    controlItems.forEach(item => {
        item.addEventListener('click', function() {
            const controlName = this.querySelector('h6').textContent;
            showToast(`${controlName} controls available in the meeting room`, 'info');
        });
    });
    
    // Footer functionality
    const currentYearElement = document.getElementById("currentYear");
    if (currentYearElement) {
        currentYearElement.textContent = new Date().getFullYear();
    }
});
</script>


@endsection
