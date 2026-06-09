@extends('components.dashmaster')

@section('body')
<div class="content-wrapper student-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-comments"></i> Discussion</h1>
                <p>Share messages with your learning community.</p>
            </div>
            <span class="count-pill" id="messageCount">{{ $messages->count() }} messages</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="blog-layout">
            <section class="panel-card">
                <div class="panel-title">
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
                                    <span>{{ $message->created_at->format('M j, g:i A') }}</span>
                                </div>
                                <p>{{ $message->message }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state" id="emptyState">No messages yet.</div>
                    @endforelse
                </div>
            </section>

            <aside class="panel-card composer-card">
                <div class="panel-title"><strong>New Message</strong></div>
                <form action="{{ route('student.blog.store') }}" method="POST" id="messageForm">
                    @csrf
                    <div class="field">
                        <label>Message</label>
                        <textarea name="message" id="messageInput" rows="7" maxlength="500" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="ui-btn ui-btn-primary" id="sendButton"><i class="fas fa-paper-plane"></i> Send</button>
                    <div class="live-status" id="liveStatus">Live updates on</div>
                </form>
            </aside>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('student.partials.clean-styles')
<script>
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
    const users = new Set(Array.from(list.querySelectorAll('[data-user-id]')).map(item => item.dataset.userId));

    function safe(value) { return document.createTextNode(value || ''); }
    function initials(user) { return ((user.firstname || 'U').charAt(0) + (user.lastname || '').charAt(0)).toUpperCase(); }
    function time(value) {
        const date = new Date(value);
        return Number.isNaN(date.getTime()) ? 'Just now' : date.toLocaleString([], { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' });
    }
    function appendMessage(message) {
        if (list.querySelector('[data-message-id="' + message.id + '"]')) return;
        const empty = document.getElementById('emptyState');
        if (empty) empty.remove();
        const user = message.user || {};
        const item = document.createElement('article');
        item.className = 'message-item' + (Number(user.id) === currentUserId ? ' mine' : '');
        item.dataset.messageId = message.id;
        item.dataset.userId = user.id || '';
        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.appendChild(safe(initials(user)));
        const body = document.createElement('div');
        body.className = 'message-body';
        const meta = document.createElement('div');
        meta.className = 'message-meta';
        const name = document.createElement('strong');
        name.appendChild(safe(((user.firstname || '') + ' ' + (user.lastname || '')).trim() || 'User'));
        const at = document.createElement('span');
        at.appendChild(safe(time(message.created_at)));
        const text = document.createElement('p');
        text.appendChild(safe(message.message));
        meta.appendChild(name);
        meta.appendChild(at);
        body.appendChild(meta);
        body.appendChild(text);
        item.appendChild(avatar);
        item.appendChild(body);
        list.appendChild(item);
        list.dataset.lastId = Math.max(Number(list.dataset.lastId || 0), Number(message.id));
        if (user.id) users.add(String(user.id));
        messageCount.textContent = list.querySelectorAll('.message-item').length + ' messages';
        participantCount.textContent = users.size + ' participants';
        list.scrollTop = list.scrollHeight;
    }
    async function refreshMessages() {
        try {
            const response = await fetch(endpoint + '?after=' + encodeURIComponent(list.dataset.lastId || 0), { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
            if (!response.ok) throw new Error('refresh');
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
        if (!message) return;
        sendButton.disabled = true;
        try {
            const body = new FormData();
            body.append('_token', token);
            body.append('message', message);
            const response = await fetch(endpoint, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body });
            const data = await response.json();
            if (!response.ok || !data.success) throw new Error('send');
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
