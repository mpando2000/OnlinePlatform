@extends('components.dashmaster')

@section('body')
<div class="content-wrapper blog-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-comments"></i> Blog</h1>
                <p>Share updates and messages with the learning community.</p>
            </div>
            <span class="count-pill" id="messageCount">{{ $messages->count() }} messages</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="blog-layout">
            <section class="messages-card">
                <div class="card-title">
                    <strong>Messages</strong>
                    <span id="participantCount">{{ $messages->unique('user_id')->count() }} participants</span>
                </div>
                <div class="message-list" id="messageList" data-last-id="{{ optional($messages->last())->id ?? 0 }}" data-current-user="{{ auth()->id() }}">
                    @forelse($messages as $message)
                        @php
                            $author = $message->user;
                            $isMine = auth()->id() === $message->user_id;
                            $initials = strtoupper(substr(optional($author)->firstname ?? 'U', 0, 1) . substr(optional($author)->lastname ?? '', 0, 1));
                        @endphp
                        <article class="message-item {{ $isMine ? 'mine' : '' }}" data-message-id="{{ $message->id }}" data-user-id="{{ $message->user_id }}">
                            <div class="avatar">{{ $initials }}</div>
                            <div class="message-body">
                                <div class="message-meta">
                                    <strong>{{ optional($author)->firstname }} {{ optional($author)->lastname }}</strong>
                                    <span>{{ ucfirst(optional($author)->role ?? 'user') }} · {{ $message->created_at->format('M j, g:i A') }}</span>
                                </div>
                                <p>{{ $message->message }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state" id="emptyState">No messages yet.</div>
                    @endforelse
                </div>
            </section>

            <aside class="composer-card">
                <div class="card-title"><strong>New Message</strong></div>
                <form action="{{ route('blogs.store') }}" method="POST" id="messageForm">
                    @csrf
                    <div class="field">
                        <label>Message</label>
                        <textarea name="message" id="messageInput" rows="7" maxlength="500" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="ui-btn ui-btn-primary" id="sendButton"><i class="fas fa-paper-plane"></i> Send Message</button>
                    <div class="live-status" id="liveStatus">Live updates on</div>
                </form>
            </aside>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.blog-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .messages-card, .composer-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}
.page-panel {
    align-items: center;
    display: flex;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 14px;
    padding: 16px 18px;
}
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.count-pill {
    background: #ecfdf5;
    border-radius: 999px;
    color: #047857;
    font-size: 12px;
    font-weight: 800;
    padding: 6px 10px;
}
.blog-layout { display: grid; gap: 14px; grid-template-columns: minmax(0, 1fr) 360px; }
.card-title {
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    padding: 13px 16px;
}
.card-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.message-list { display: grid; gap: 10px; max-height: 620px; overflow: auto; padding: 16px; }
.message-item { align-items: flex-start; display: flex; gap: 10px; }
.message-item.mine { flex-direction: row-reverse; }
.avatar {
    align-items: center;
    background: #123d35;
    border-radius: 50%;
    color: #fff;
    display: flex;
    flex: 0 0 38px;
    font-size: 13px;
    font-weight: 800;
    height: 38px;
    justify-content: center;
    width: 38px;
}
.message-body { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; max-width: 760px; padding: 10px 12px; }
.message-item.mine .message-body { background: #ecfdf5; border-color: #d1fae5; }
.message-meta { display: flex; flex-wrap: wrap; gap: 8px; justify-content: space-between; margin-bottom: 4px; }
.message-meta strong { color: #172033; }
.message-meta span { color: #6b7280; font-size: 12px; }
.message-body p { color: #172033; margin: 0; white-space: pre-wrap; }
.composer-card { align-self: start; }
.composer-card form { padding: 16px; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field textarea { border: 1px solid #d7dde6; border-radius: 6px; padding: 9px 11px; resize: vertical; width: 100%; }
.field textarea:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; margin-top: 12px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.live-status { color: #047857; font-size: 12px; font-weight: 800; margin-top: 10px; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
@media (max-width: 1000px) { .blog-layout { grid-template-columns: 1fr; } }
@media (max-width: 768px) { .page-panel { align-items: flex-start; flex-direction: column; } }
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();

(function() {
    const list = document.getElementById('messageList');
    const form = document.getElementById('messageForm');
    const input = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const messageCount = document.getElementById('messageCount');
    const participantCount = document.getElementById('participantCount');
    const liveStatus = document.getElementById('liveStatus');
    const currentUserId = Number(list.dataset.currentUser || 0);
    const token = form.querySelector('input[name="_token"]').value;
    const endpoint = form.action;
    const users = new Set(Array.from(list.querySelectorAll('[data-user-id]')).map(function(item) {
        return item.dataset.userId;
    }));

    function initials(user) {
        const first = (user && user.firstname ? user.firstname : 'U').charAt(0);
        const last = (user && user.lastname ? user.lastname : '').charAt(0);
        return (first + last).toUpperCase();
    }

    function formatTime(value) {
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) {
            return 'Just now';
        }
        return date.toLocaleString([], { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' });
    }

    function text(value) {
        return document.createTextNode(value || '');
    }

    function appendMessage(message) {
        if (list.querySelector('[data-message-id="' + message.id + '"]')) {
            return;
        }

        const empty = document.getElementById('emptyState');
        if (empty) {
            empty.remove();
        }

        const user = message.user || {};
        const isMine = Number(user.id) === currentUserId;
        const item = document.createElement('article');
        item.className = 'message-item' + (isMine ? ' mine' : '');
        item.dataset.messageId = message.id;
        item.dataset.userId = user.id || '';

        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.appendChild(text(initials(user)));

        const body = document.createElement('div');
        body.className = 'message-body';

        const meta = document.createElement('div');
        meta.className = 'message-meta';

        const name = document.createElement('strong');
        name.appendChild(text(((user.firstname || '') + ' ' + (user.lastname || '')).trim() || 'User'));

        const time = document.createElement('span');
        time.appendChild(text((user.role ? user.role.charAt(0).toUpperCase() + user.role.slice(1) : 'User') + ' · ' + formatTime(message.created_at)));

        const paragraph = document.createElement('p');
        paragraph.appendChild(text(message.message));

        meta.appendChild(name);
        meta.appendChild(time);
        body.appendChild(meta);
        body.appendChild(paragraph);
        item.appendChild(avatar);
        item.appendChild(body);
        list.appendChild(item);

        list.dataset.lastId = Math.max(Number(list.dataset.lastId || 0), Number(message.id));
        if (user.id) {
            users.add(String(user.id));
        }
        messageCount.textContent = list.querySelectorAll('.message-item').length + ' messages';
        participantCount.textContent = users.size + ' participants';
        list.scrollTop = list.scrollHeight;
    }

    async function refreshMessages() {
        try {
            const response = await fetch(endpoint + '?after=' + encodeURIComponent(list.dataset.lastId || 0), {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            if (!response.ok) {
                throw new Error('Refresh failed');
            }
            const data = await response.json();
            (data.messages || []).forEach(appendMessage);
            liveStatus.textContent = 'Live updates on';
        } catch (error) {
            liveStatus.textContent = 'Live updates reconnecting';
        }
    }

    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        const message = input.value.trim();
        if (!message) {
            return;
        }

        sendButton.disabled = true;
        try {
            const body = new FormData();
            body.append('_token', token);
            body.append('message', message);

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: body
            });
            const data = await response.json();
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Send failed');
            }
            appendMessage(data.message);
            input.value = '';
            input.focus();
        } catch (error) {
            liveStatus.textContent = 'Message not sent. Try again.';
        } finally {
            sendButton.disabled = false;
        }
    });

    list.scrollTop = list.scrollHeight;
    setInterval(refreshMessages, 3000);
})();
</script>
@endsection
