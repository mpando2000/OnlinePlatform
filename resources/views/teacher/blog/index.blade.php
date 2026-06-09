@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">
                        <i class="fas fa-chalkboard-teacher text-success mr-2"></i>
                        Teacher Blog
                    </h1>
                    <p class="text-muted mb-0">Connect with students and share educational insights</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="chat-status teacher">
                        <i class="fas fa-circle text-success mr-1 pulse"></i>
                        <span id="online-count">{{ $messages->unique('user_id')->count() }}</span> participants online
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
                    <div class="chat-container teacher-theme">
                        <!-- Chat Header -->
                        <div class="chat-header-card teacher">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="chat-avatar-group">
                                        <div class="avatar-stack">
                                            @php
                                                $uniqueUsers = $messages->unique('user_id')->take(4);
                                            @endphp
                                            @foreach($uniqueUsers as $user)
                                                <div class="avatar-item" title="{{ $user->user->firstname }} {{ $user->user->lastname }}">
                                                    <div class="avatar-circle {{ $user->user->role === 'teacher' ? 'teacher-avatar' : '' }}">
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
                                        <h5 class="mb-0">Educational Discussion</h5>
                                        <small class="text-white-50">
                                            <span id="message-count">{{ $messages->count() }}</span> messages
                                            <span class="mx-2">•</span>
                                            <span id="last-updated">Just now</span>
                                        </small>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    <button class="btn btn-outline-light btn-sm" onclick="scrollToTop()">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button class="btn btn-outline-light btn-sm" onclick="refreshMessages()">
                                        <i class="fas fa-sync-alt" id="refresh-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    

                        <!-- Chat Messages -->
                        <div class="chat-messages-container teacher" id="chat-messages">
                            <div id="messages-loading" class="text-center py-4" style="display: none;">
                                <i class="fas fa-spinner fa-spin text-success"></i>
                                <p class="text-muted mt-2">Loading messages...</p>
                            </div>
                            
                            <div id="chat-history">
                                @php
                                    $currentUser = auth()->user();
                                @endphp
                                @foreach($messages as $message)
                                    <div class="message-wrapper {{ $message->user_id == $currentUser->id ? 'own-message' : 'other-message' }}"
                                         data-message-id="{{ $message->id }}">
                                        <div class="message-content">
                                            @if($message->user_id != $currentUser->id)
                                                <div class="message-avatar">
                                                    <div class="avatar-circle small {{ $message->user->role === 'teacher' ? 'teacher-avatar' : '' }}">
                                                        {{ strtoupper(substr($message->user->firstname, 0, 1)) }}{{ strtoupper(substr($message->user->lastname, 0, 1)) }}
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            <div class="message-bubble {{ $message->user_id == $currentUser->id ? 'teacher-own' : '' }}">
                                                @if($message->user_id != $currentUser->id)
                                                    <div class="message-header">
                                                        <span class="message-author {{ $message->user->role === 'teacher' ? 'teacher-name' : '' }}">
                                                            {{ $message->user->firstname }} {{ $message->user->lastname }}
                                                            @if($message->user->role === 'teacher')
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
                        <div class="chat-input-container teacher">
                            <form id="message-form" class="message-form" action="{{ route('teacher.blog.store') }}" method="POST">
                                @csrf
                                <div class="input-wrapper teacher">
                                    <button type="button" class="emoji-btn" onclick="toggleEmojiPicker()">
                                        <i class="far fa-smile"></i>
                                    </button>
                                    <input 
                                        type="text" 
                                        name="message" 
                                        id="message-input"
                                        class="message-input" 
                                        placeholder="Share your educational insights..." 
                                        autocomplete="off"
                                        maxlength="500"
                                        required
                                    >
                                    <div class="input-actions">
                                        <div class="character-count">
                                            <span id="char-count">0</span>/500
                                        </div>
                                        <button type="submit" class="send-btn teacher" id="send-btn" disabled>
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
/* Teacher-specific theme colors */
.teacher-theme {
    --primary-color: #28a745;
    --primary-light: rgba(40, 167, 69, 0.1);
    --primary-dark: #1e7e34;
}

.chat-container.teacher-theme {
    max-width: 100%;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    overflow: hidden;
}

.chat-header-card.teacher {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 20px 20px 0 0;
}

.chat-status.teacher {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    font-weight: 500;
    font-size: 0.9rem;
}

.teacher-privilege-notice {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
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

.avatar-circle.teacher-avatar {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: 3px solid #ffc107;
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

.chat-messages-container.teacher {
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

.own-message .message-bubble.teacher-own {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border-bottom-right-radius: 4px;
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

.message-author.teacher-name {
    color: #28a745;
}

.teacher-badge {
    color: #ffc107;
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

.chat-input-container.teacher {
    padding: 1rem;
    background: white;
    border-top: 1px solid #e9ecef;
    border-radius: 0 0 20px 20px;
}

.input-wrapper.teacher {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 25px;
    padding: 8px 16px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.input-wrapper.teacher:focus-within {
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
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
    color: #28a745;
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

.send-btn.teacher {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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

.send-btn.teacher:enabled {
    opacity: 1;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.send-btn.teacher:hover:enabled {
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
    background: #28a745;
    color: white;
    padding: 12px 20px;
    border-radius: 25px;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
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
    background: #28a745;
    border-radius: 3px;
}

.chat-messages-container::-webkit-scrollbar-thumb:hover {
    background: #20c997;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .chat-container.teacher-theme {
        margin: 0;
        border-radius: 0;
        min-height: calc(100vh - 120px);
    }
    
    .chat-header-card.teacher {
        border-radius: 0;
        padding: 1rem;
    }
    
    .message-content {
        max-width: 85%;
    }
    
    .avatar-stack {
        display: none;
    }
    
    .chat-messages-container.teacher {
        height: calc(100vh - 320px);
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
</style>

<script>
let lastMessageId = {{ $messages->max('id') ?? 0 }};
let refreshInterval;
let isTyping = false;
let typingTimeout;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    scrollToBottom();
    startAutoRefresh();
    
    console.log('Teacher blog page initialized');
    console.log('Routes:', {
        store: '{{ route("teacher.blog.store") }}',
        index: '{{ route("teacher.blog") }}'
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
        
        // Update character count color (teacher theme)
        if (length > 450) {
            charCount.style.color = '#dc3545'; // Red
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
    const message = messageInput.value.trim();
    
    if (!message) return;
    
    // Disable form
    const sendBtn = document.getElementById('send-btn');
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;
    
    console.log('Sending teacher message:', message);
    console.log('CSRF Token:', csrfToken);
    
    // Send via AJAX with proper headers
    fetch('{{ route("teacher.blog.store") }}', {
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
            
            showSuccessMessage('Educational insight shared successfully!');
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
    
    const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    const isTeacher = message.user.role === 'teacher';
    
    messageWrapper.innerHTML = `
        <div class="message-content">
            ${!isOwn ? `
                <div class="message-avatar">
                    <div class="avatar-circle small ${isTeacher ? 'teacher-avatar' : ''}">
                        ${message.user.firstname.charAt(0).toUpperCase()}${message.user.lastname.charAt(0).toUpperCase()}
                    </div>
                </div>
            ` : ''}
            
            <div class="message-bubble ${isOwn ? 'teacher-own' : ''}">
                ${!isOwn ? `
                    <div class="message-header">
                        <span class="message-author ${isTeacher ? 'teacher-name' : ''}">${message.user.firstname} ${message.user.lastname}
                        ${isTeacher ? '<i class="fas fa-chalkboard-teacher ml-1 teacher-badge"></i>' : ''}
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
        </div>
    `;
    
    chatHistory.appendChild(messageWrapper);
    lastMessageId = Math.max(lastMessageId, message.id);
    updateMessageCount();
}

function refreshMessages() {
    const refreshIcon = document.getElementById('refresh-icon');
    refreshIcon.classList.add('spinning');
    
    fetch(`{{ route('teacher.blog') }}?after=${lastMessageId}`, {
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
    const emojis = ['📚', '✏️', '🎓', '👨‍🏫', '📖', '💡', '⭐', '👍', '🌟', '📝'];
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