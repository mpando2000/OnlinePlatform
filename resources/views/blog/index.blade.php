

@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-comments me-2"></i>
                        Administrator Blog
                    </h1>
                    <p class="page-description" style="margin:0;">Monitor and manage platform-wide discussions with full administrative privileges</p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Community Hub</li>
                    </ol>
                </nav>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <div class="chat-status admin">
                        <i class="fas fa-circle text-success mr-1 pulse"></i>
                        <span id="online-count">{{ $messages->unique('user_id')->count() }}</span> participants monitored
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <!-- Chat Container -->
                    <div class="chat-container admin-theme">
                        <!-- Chat Header -->
                        <div class="chat-header-card admin">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="chat-avatar-group">
                                        <div class="avatar-stack">
                                            @php
                                                $uniqueUsers = $messages->unique('user_id')->take(4);
                                            @endphp
                                            @foreach($uniqueUsers as $user)
                                                <div class="avatar-item" title="{{ $user->user->firstname }} {{ $user->user->lastname }}">
                                                    <div class="avatar-circle {{ $user->user->role === 'admin' ? 'admin-avatar' : ($user->user->role === 'teacher' ? 'teacher-avatar' : '') }}">
                                                        {{ strtoupper(substr($user->user->firstname, 0, 1)) }}{{ strtoupper(substr($user->user->lastname, 0, 1)) }}
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($messages->unique('user_id')->count() > 4)
                                                <div class="avatar-item">
                                                    <div class="avatar-circle more">
                                                        +{{ $messages->unique('user_id')->count() - 4 }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="chat-info">
                                        <h5 class="mb-0">Platform-Wide Communication</h5>
                                        <small class="text-white-50">
                                            <span id="message-count">{{ $messages->count() }}</span> messages
                                            <span class="mx-2">•</span>
                                            <span id="last-updated">Just now</span>
                                        </small>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <button class="btn btn-outline-light btn-sm" onclick="scrollToTop()" title="Scroll to top">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button class="btn btn-outline-light btn-sm" onclick="refreshMessages()" title="Refresh messages">
                                        <i class="fas fa-sync-alt" id="refresh-icon"></i>
                                    </button>
                                    <button class="btn btn-outline-light btn-sm" onclick="toggleModeratorPanel()" title="Moderation tools">
                                        <i class="fas fa-cogs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Privilege Notice -->
                        

                        <!-- Chat Messages -->
                        <div class="chat-messages-container admin" id="chat-messages">
                            <div id="messages-loading" class="text-center py-4" style="display: none;">
                                <i class="fas fa-spinner fa-spin text-danger"></i>
                                <p class="text-muted mt-2">Loading messages...</p>
                            </div>
                            
                            <div id="chat-history">
                                @php
                                    $currentUser = auth()->user();
                                @endphp
                                @foreach($messages as $message)
                                    <div class="message-wrapper {{ $message->user_id == $currentUser->id ? 'own-message' : 'other-message' }}"
                                         data-message-id="{{ $message->id }}"
                                         data-user-role="{{ $message->user->role }}">
                                        <div class="message-content">
                                            @if($message->user_id != $currentUser->id)
                                                <div class="message-avatar">
                                                    <div class="avatar-circle small {{ $message->user->role === 'admin' ? 'admin-avatar' : ($message->user->role === 'teacher' ? 'teacher-avatar' : '') }}">
                                                        {{ strtoupper(substr($message->user->firstname, 0, 1)) }}{{ strtoupper(substr($message->user->lastname, 0, 1)) }}
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            <div class="message-bubble {{ $message->user_id == $currentUser->id ? 'admin-own' : '' }}">
                                                @if($message->user_id != $currentUser->id)
                                                    <div class="message-header">
                                                        <span class="message-author {{ $message->user->role === 'admin' ? 'admin-name' : ($message->user->role === 'teacher' ? 'teacher-name' : '') }}">
                                                            {{ $message->user->firstname }} {{ $message->user->lastname }}
                                                            @if($message->user->role === 'admin')
                                                                <i class="fas fa-crown ml-1 admin-badge"></i>
                                                            @elseif($message->user->role === 'teacher')
                                                                <i class="fas fa-chalkboard-teacher ml-1 teacher-badge"></i>
                                                            @endif
                                                        </span>
                                                        <span class="message-time">{{ $message->created_at->format('h:i A') }}</span>
                                                    </div>
                                                @endif
                                                <div class="message-text">{{ $message->message }}</div>
                                                @if($message->user_id == $currentUser->id)
                                                    <div class="message-time-own">{{ $message->created_at->format('h:i A') }}</div>
                                                @endif
                                            </div>

                                            @if($message->user_id == $currentUser->id)
                                                <div class="message-status">
                                                    <i class="fas fa-check text-success"></i>
                                                </div>
                                            @endif

                                            <!-- Admin Controls -->
                                            @if($message->user_id != $currentUser->id)
                                                <div class="admin-controls" style="display: none;">
                                                    <button class="btn btn-sm btn-outline-warning" onclick="moderateMessage({{ $message->id }}, 'warn')" title="Warn user">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="moderateMessage({{ $message->id }}, 'delete')" title="Delete message">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Typing Indicator -->
                        <div id="typing-indicator" class="typing-indicator" style="display: none;">
                            <div class="message-wrapper other-message">
                                <div class="message-content">
                                    <div class="message-avatar">
                                        <div class="avatar-circle small">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="typing-bubble">
                                        <div class="typing-dots">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message Input -->
                        <div class="chat-input-container admin">
                            <form id="message-form" class="message-form" action="{{ route('blogs.store') }}" method="POST">
                                @csrf
                                <div class="input-wrapper admin">
                                    <button type="button" class="emoji-btn" onclick="toggleEmojiPicker()">
                                        <i class="far fa-smile"></i>
                                    </button>
                                    <input 
                                        type="text" 
                                        name="message" 
                                        id="message-input"
                                        class="message-input" 
                                        placeholder="Send administrative announcement or join the discussion..." 
                                        autocomplete="off"
                                        maxlength="500"
                                        required
                                    >
                                    <div class="input-actions">
                                        <div class="character-count">
                                            <span id="char-count">0</span>/500
                                        </div>
                                        <button type="button" class="broadcast-btn" onclick="toggleBroadcastMode()" title="Broadcast mode">
                                            <i class="fas fa-bullhorn"></i>
                                        </button>
                                        <button type="submit" class="send-btn admin" id="send-btn" disabled>
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
/* Admin-specific theme colors */
.admin-theme {
    --primary-color: #155724;
    --primary-light: rgba(21, 87, 36, 0.1);
    --primary-dark: #0d3a20;
}

.chat-container.admin-theme {
    max-width: 100%;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    overflow: hidden;
    border: 2px solid rgba(21, 87, 36, 0.1);
}

.chat-header-card.admin {
    background: linear-gradient(135deg, #155724 0%, #28a745 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 20px 20px 0 0;
    position: relative;
}

.chat-header-card.admin::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #28a745, #20c997, #155724, #17a2b8);
}

.chat-status.admin {
    background: rgba(21, 87, 36, 0.1);
    color: #155724;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    font-weight: 500;
    font-size: 0.9rem;
}

.admin-privilege-notice {
    background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
    color: white;
    padding: 1rem 1.5rem;
    margin-bottom: 0;
}

.privilege-icon {
    background: rgba(255,255,255,0.2);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.1rem;
}

.admin-stats .stat-item {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.avatar-stack {
    display: flex;
    margin-right: 1rem;
}

.avatar-item {
    margin-left: -8px;
}

.avatar-item:first-child {
    margin-left: 0;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 0.8rem;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.avatar-circle.admin-avatar {
    background: linear-gradient(135deg, #155724, #28a745);
    border: 3px solid #20c997;
    box-shadow: 0 0 15px rgba(21, 87, 36, 0.3);
}

.avatar-circle.teacher-avatar {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: 3px solid #20c997;
}

.avatar-circle.small {
    width: 32px;
    height: 32px;
    font-size: 0.7rem;
}

.avatar-circle.more {
    background: #6c757d;
    font-size: 0.7rem;
}

.chat-info h5 {
    color: white;
    margin-bottom: 0.25rem;
}

.chat-messages-container.admin {
    height: 500px;
    overflow-y: auto;
    padding: 1rem;
    background: #f8f9fa;
    scroll-behavior: smooth;
}

.message-wrapper {
    margin-bottom: 1rem;
    display: flex;
    animation: fadeInUp 0.3s ease;
    position: relative;
}

.message-wrapper:hover .admin-controls {
    display: flex !important;
}

.message-wrapper.own-message {
    justify-content: flex-end;
}

.message-wrapper.other-message {
    justify-content: flex-start;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message-content {
    display: flex;
    align-items: flex-end;
    max-width: 70%;
    position: relative;
}

.own-message .message-content {
    flex-direction: row-reverse;
}

.message-avatar {
    margin: 0 8px 4px;
}

.message-bubble {
    padding: 0.75rem 1rem;
    border-radius: 18px;
    position: relative;
    word-wrap: break-word;
}

.other-message .message-bubble {
    background: white;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.own-message .message-bubble.admin-own {
    background: linear-gradient(135deg, #155724 0%, #28a745 100%);
    color: white;
    border-bottom-right-radius: 4px;
    box-shadow: 0 4px 15px rgba(21, 87, 36, 0.3);
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.25rem;
}

.message-author {
    font-weight: 600;
    font-size: 0.85rem;
    color: #667eea;
}

.message-author.admin-name {
    color: #155724;
    font-weight: 700;
}

.message-author.teacher-name {
    color: #28a745;
}

.admin-badge {
    color: #20c997;
    font-size: 0.8rem;
    text-shadow: 0 0 5px rgba(32, 201, 151, 0.5);
}

.teacher-badge {
    color: #20c997;
    font-size: 0.8rem;
}

.message-time, .message-time-own {
    font-size: 0.75rem;
    opacity: 0.7;
}

.message-time {
    color: #6c757d;
}

.message-time-own {
    text-align: right;
    margin-top: 0.25rem;
    color: rgba(255,255,255,0.8);
}

.message-text {
    line-height: 1.4;
    font-size: 0.95rem;
}

.message-status {
    margin: 0 8px 4px;
    opacity: 0.7;
}

.admin-controls {
    position: absolute;
    right: -60px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.admin-controls .btn {
    width: 30px;
    height: 30px;
    padding: 0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.typing-indicator {
    margin-bottom: 1rem;
}

.typing-bubble {
    background: white;
    padding: 1rem;
    border-radius: 18px;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.typing-dots {
    display: flex;
    gap: 4px;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    background: #999;
    border-radius: 50%;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) { animation-delay: 0s; }
.typing-dots span:nth-child(2) { animation-delay: 0.2s; }
.typing-dots span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: scale(1); opacity: 0.5; }
    30% { transform: scale(1.2); opacity: 1; }
}

.chat-input-container.admin {
    padding: 1rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-top: 1px solid #e9ecef;
    border-radius: 0 0 20px 20px;
}

.input-wrapper.admin {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 25px;
    padding: 8px 16px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.input-wrapper.admin:focus-within {
    border-color: #155724;
    box-shadow: 0 0 0 3px rgba(21, 87, 36, 0.1);
}

.emoji-btn {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 1.2rem;
    margin-right: 8px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.emoji-btn:hover {
    color: #155724;
}

.message-input {
    flex: 1;
    border: none;
    background: none;
    outline: none;
    font-size: 1rem;
    padding: 8px 0;
}

.input-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.character-count {
    font-size: 0.75rem;
    color: #6c757d;
}

.broadcast-btn {
    background: #17a2b8;
    border: none;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.broadcast-btn:hover {
    background: #138496;
    transform: scale(1.05);
}

.broadcast-btn.active {
    background: #ffc107;
    color: #212529;
}

.send-btn.admin {
    background: linear-gradient(135deg, #155724 0%, #28a745 100%);
    border: none;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0.5;
}

.send-btn.admin:enabled {
    opacity: 1;
    box-shadow: 0 4px 15px rgba(21, 87, 36, 0.3);
}

.send-btn.admin:hover:enabled {
    transform: scale(1.05);
}

.chat-actions .btn {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 8px;
}

#refresh-icon.spinning {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.new-message-alert {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #155724;
    color: white;
    padding: 12px 20px;
    border-radius: 25px;
    box-shadow: 0 4px 15px rgba(21, 87, 36, 0.3);
    z-index: 1000;
    cursor: pointer;
    animation: slideInRight 0.3s ease;
}

@keyframes slideInRight {
    from { transform: translateX(100%); }
    to { transform: translateX(0); }
}

/* Scrollbar Styling */
.chat-messages-container::-webkit-scrollbar {
    width: 6px;
}

.chat-messages-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chat-messages-container::-webkit-scrollbar-thumb {
    background: #155724;
    border-radius: 3px;
}

.chat-messages-container::-webkit-scrollbar-thumb:hover {
    background: #0d3a20;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .chat-container.admin-theme {
        margin: 0;
        border-radius: 0;
        min-height: calc(100vh - 120px);
    }
    
    .chat-header-card.admin {
        border-radius: 0;
        padding: 1rem;
    }
    
    .message-content {
        max-width: 85%;
    }
    
    .avatar-stack {
        display: none;
    }
    
    .chat-messages-container.admin {
        height: calc(100vh - 320px);
    }

    .admin-controls {
        display: none !important;
    }
}

/* Loading Animation */
.loading-pulse {
    animation: pulse-loading 1.5s ease-in-out infinite;
}

@keyframes pulse-loading {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
}

/* Broadcast Mode */
.broadcast-mode .message-input {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(253, 126, 20, 0.1));
    font-weight: 500;
}

.broadcast-mode .input-wrapper.admin {
    border-color: #ffc107;
    box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
}

/* Page header styles for consistency */
.page-header {
    background: white;
    padding: 20px 30px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.page-title i {
    color: #155724;
}

.page-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

.breadcrumb-custom {
    background: transparent;
    margin-bottom: 0;
    padding: 0;
}
</style>

<script>
let lastMessageId = {{ $messages->max('id') ?? 0 }};
let refreshInterval;
let isTyping = false;
let typingTimeout;
let isBroadcastMode = false;
let moderatorPanelVisible = false;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    scrollToBottom();
    startAutoRefresh();
    
    console.log('Admin blog page initialized');
    console.log('Routes:', {
        store: '{{ route("blogs.store") }}',
        index: '{{ route("blogs.index") }}'
    });
    
    // Message form handling
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const sendBtn = document.getElementById('send-btn');
    const charCount = document.getElementById('char-count');
    
    console.log('Form elements found:', {
        form: !!messageForm,
        input: !!messageInput,
        button: !!sendBtn,
        counter: !!charCount
    });
    
    // Character counter
    messageInput.addEventListener('input', function() {
        const length = this.value.trim().length;
        charCount.textContent = length;
        sendBtn.disabled = length === 0;
        
        // Update character count color (admin theme)
        if (length > 450) {
            charCount.style.color = '#155724'; // Dark Green
        } else if (length > 400) {
            charCount.style.color = '#ffc107'; // Yellow
        } else {
            charCount.style.color = '#6c757d'; // Default
        }
        
        // Show typing indicator
        if (length > 0) {
            showTypingIndicator();
        }
    });
    
    // Form submission
    messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage();
    });
    
    // Enter key handling
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!sendBtn.disabled) {
                sendMessage();
            }
        }
    });
    
    // Auto-scroll on new messages
    const chatContainer = document.getElementById('chat-messages');
    const observer = new MutationObserver(function() {
        if (isNearBottom()) {
            scrollToBottom();
        } else {
            showNewMessageAlert();
        }
    });
    
    observer.observe(document.getElementById('chat-history'), {
        childList: true
    });
});

function sendMessage() {
    const messageInput = document.getElementById('message-input');
    let message = messageInput.value.trim();
    
    if (!message) return;
    
    // Add broadcast prefix if in broadcast mode
    if (isBroadcastMode) {
        message = '📢 [ADMIN ANNOUNCEMENT] ' + message;
    }
    
    // Disable form
    const sendBtn = document.getElementById('send-btn');
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;
    
    console.log('Sending admin message:', message);
    console.log('Broadcast mode:', isBroadcastMode);
    
    // Send via AJAX with proper headers
    fetch('{{ route("blogs.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            message: message
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response:', text);
                throw new Error(`HTTP ${response.status}: ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            // Clear input
            messageInput.value = '';
            document.getElementById('char-count').textContent = '0';
            
            // Add message to chat
            addMessageToChat(data.message, true);
            scrollToBottom();
            
            // Hide typing indicator
            hideTypingIndicator();
            
            if (isBroadcastMode) {
                showSuccessMessage('Administrative announcement broadcasted successfully!');
                toggleBroadcastMode(); // Turn off broadcast mode after sending
            } else {
                showSuccessMessage('Administrative message sent successfully!');
            }
        } else {
            throw new Error(data.message || 'Unknown error occurred');
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        let errorMessage = 'Failed to send message. ';
        
        if (error.message.includes('422')) {
            errorMessage += 'Please check your message and try again.';
        } else if (error.message.includes('500')) {
            errorMessage += 'Server error occurred. Please try again later.';
        } else if (error.message.includes('Network')) {
            errorMessage += 'Network error. Please check your connection.';
        } else {
            errorMessage += error.message;
        }
        
        showErrorMessage(errorMessage);
    })
    .finally(() => {
        // Re-enable form
        sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
        sendBtn.disabled = messageInput.value.trim().length === 0;
        messageInput.focus();
    });
}

function addMessageToChat(message, isOwn = false) {
    const chatHistory = document.getElementById('chat-history');
    const messageWrapper = document.createElement('div');
    messageWrapper.className = `message-wrapper ${isOwn ? 'own-message' : 'other-message'}`;
    messageWrapper.setAttribute('data-message-id', message.id);
    messageWrapper.setAttribute('data-user-role', message.user.role);
    
    const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    const isAdmin = message.user.role === 'admin';
    const isTeacher = message.user.role === 'teacher';
    
    messageWrapper.innerHTML = `
        <div class="message-content">
            ${!isOwn ? `
                <div class="message-avatar">
                    <div class="avatar-circle small ${isAdmin ? 'admin-avatar' : (isTeacher ? 'teacher-avatar' : '')}">
                        ${message.user.firstname.charAt(0).toUpperCase()}${message.user.lastname.charAt(0).toUpperCase()}
                    </div>
                </div>
            ` : ''}
            
            <div class="message-bubble ${isOwn ? 'admin-own' : ''}">
                ${!isOwn ? `
                    <div class="message-header">
                        <span class="message-author ${isAdmin ? 'admin-name' : (isTeacher ? 'teacher-name' : '')}">${message.user.firstname} ${message.user.lastname}
                        ${isAdmin ? '<i class="fas fa-crown ml-1 admin-badge"></i>' : (isTeacher ? '<i class="fas fa-chalkboard-teacher ml-1 teacher-badge"></i>' : '')}
                        </span>
                        <span class="message-time">${currentTime}</span>
                    </div>
                ` : ''}
                <div class="message-text">${message.message}</div>
                ${isOwn ? `<div class="message-time-own">${currentTime}</div>` : ''}
            </div>

            ${isOwn ? `
                <div class="message-status">
                    <i class="fas fa-check text-success"></i>
                </div>
            ` : ''}

            ${!isOwn ? `
                <div class="admin-controls" style="display: none;">
                    <button class="btn btn-sm btn-outline-warning" onclick="moderateMessage(${message.id}, 'warn')" title="Warn user">
                        <i class="fas fa-exclamation-triangle"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="moderateMessage(${message.id}, 'delete')" title="Delete message">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ` : ''}
        </div>
    `;
    
    chatHistory.appendChild(messageWrapper);
    lastMessageId = Math.max(lastMessageId, message.id);
    updateMessageCount();
}

function refreshMessages() {
    const refreshIcon = document.getElementById('refresh-icon');
    refreshIcon.classList.add('spinning');
    
    fetch(`{{ route('blogs.index') }}?after=${lastMessageId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.messages && data.messages.length > 0) {
            data.messages.forEach(message => {
                addMessageToChat(message, false);
            });
        }
        updateLastUpdated();
    })
    .catch(error => {
        console.error('Refresh error:', error);
    })
    .finally(() => {
        refreshIcon.classList.remove('spinning');
    });
}

function toggleBroadcastMode() {
    isBroadcastMode = !isBroadcastMode;
    const broadcastBtn = document.querySelector('.broadcast-btn');
    const inputWrapper = document.querySelector('.input-wrapper.admin');
    const messageInput = document.getElementById('message-input');
    
    if (isBroadcastMode) {
        broadcastBtn.classList.add('active');
        inputWrapper.classList.add('broadcast-mode');
        messageInput.placeholder = '📢 Type your administrative announcement...';
        showSuccessMessage('Broadcast mode activated - your next message will be announced to all users');
    } else {
        broadcastBtn.classList.remove('active');
        inputWrapper.classList.remove('broadcast-mode');
        messageInput.placeholder = 'Send administrative announcement or join the discussion...';
    }
}

function toggleModeratorPanel() {
    moderatorPanelVisible = !moderatorPanelVisible;
    const controls = document.querySelectorAll('.admin-controls');
    
    controls.forEach(control => {
        control.style.display = moderatorPanelVisible ? 'flex' : 'none';
    });
    
    showSuccessMessage(moderatorPanelVisible ? 'Moderation panel activated' : 'Moderation panel deactivated');
}

function moderateMessage(messageId, action) {
    if (action === 'warn') {
        showSuccessMessage('Warning sent to user (demo functionality)');
    } else if (action === 'delete') {
        if (confirm('Are you sure you want to delete this message?')) {
            // In a real implementation, this would make an AJAX call to delete the message
            const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
            if (messageElement) {
                messageElement.style.opacity = '0.5';
                messageElement.style.textDecoration = 'line-through';
                showSuccessMessage('Message marked for deletion (demo functionality)');
            }
        }
    }
}

function startAutoRefresh() {
    refreshInterval = setInterval(refreshMessages, 5000);
}

function stopAutoRefresh() {
    if (refreshInterval) {
        clearInterval(refreshInterval);
    }
}

function scrollToBottom() {
    const container = document.getElementById('chat-messages');
    container.scrollTop = container.scrollHeight;
}

function scrollToTop() {
    const container = document.getElementById('chat-messages');
    container.scrollTop = 0;
}

function isNearBottom() {
    const container = document.getElementById('chat-messages');
    return container.scrollTop + container.clientHeight >= container.scrollHeight - 50;
}

function showTypingIndicator() {
    if (isTyping) return;
    
    isTyping = true;
    document.getElementById('typing-indicator').style.display = 'block';
    scrollToBottom();
    
    if (typingTimeout) {
        clearTimeout(typingTimeout);
    }
    
    typingTimeout = setTimeout(hideTypingIndicator, 2000);
}

function hideTypingIndicator() {
    isTyping = false;
    document.getElementById('typing-indicator').style.display = 'none';
}

function showNewMessageAlert() {
    const existingAlert = document.querySelector('.new-message-alert');
    if (existingAlert) return;
    
    const alert = document.createElement('div');
    alert.className = 'new-message-alert';
    alert.innerHTML = '<i class="fas fa-arrow-down mr-2"></i>New messages';
    alert.onclick = function() {
        scrollToBottom();
        this.remove();
    };
    
    document.body.appendChild(alert);
    
    setTimeout(() => {
        if (document.body.contains(alert)) {
            alert.remove();
        }
    }, 5000);
}

function updateMessageCount() {
    const count = document.querySelectorAll('.message-wrapper').length;
    document.getElementById('message-count').textContent = count;
}

function updateLastUpdated() {
    document.getElementById('last-updated').textContent = 'Just now';
}

function showErrorMessage(message) {
    const toast = document.createElement('div');
    toast.className = 'alert alert-danger position-fixed';
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 1050; max-width: 400px;';
    toast.innerHTML = `<strong>Error:</strong> ${message}`;
    
    document.body.appendChild(toast);
    setTimeout(() => {
        if (document.body.contains(toast)) {
            document.body.removeChild(toast);
        }
    }, 5000);
}

function showSuccessMessage(message) {
    const toast = document.createElement('div');
    toast.className = 'alert alert-success position-fixed';
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 1050; max-width: 400px;';
    toast.innerHTML = `<strong>Success:</strong> ${message}`;
    
    document.body.appendChild(toast);
    setTimeout(() => {
        if (document.body.contains(toast)) {
            document.body.removeChild(toast);
        }
    }, 3000);
}

function toggleEmojiPicker() {
    const emojis = ['📢', '⚡', '🔥', '🎯', '📊', '🛡️', '⚙️', '📋', '🚀', '💼'];
    const randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
    const messageInput = document.getElementById('message-input');
    messageInput.value += randomEmoji;
    messageInput.focus();
    document.getElementById('char-count').textContent = messageInput.value.length;
}

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    stopAutoRefresh();
});

// Pause refresh when page is hidden
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        stopAutoRefresh();
    } else {
        startAutoRefresh();
        refreshMessages();
    }
});
</script>


@endsection




