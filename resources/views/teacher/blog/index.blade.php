@extends('components.dashmaster')

@section('body')
@php
    $currentUserId = auth()->id();
    $lastMessageId = optional($messages->last())->id ?? 0;
@endphp

<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-comments"></i> Blog</h1>
                <p>Share messages with your learning community.</p>
            </div>
            <span class="count-pill" id="messageCount">{{ $messages->count() }} messages</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger panel-alert">
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
                <div class="message-list" id="messageList" data-last-id="{{ $lastMessageId }}" data-current-user="{{ $currentUserId }}">
                    @forelse($messages as $message)
                        @php
                            $author = $message->user;
                            $isMine = $currentUserId === $message->user_id;
                            $initials = strtoupper(substr(optional($author)->firstname ?? 'U', 0, 1) . substr(optional($author)->lastname ?? '', 0, 1));
                        @endphp
                        <article class="message-item {{ $isMine ? 'mine' : '' }}" data-message-id="{{ $message->id }}" data-user-id="{{ $message->user_id }}">
                            <div class="avatar">{{ $initials }}</div>
                            <div class="message-body">
                                <div class="message-meta">
                                    <strong>{{ optional($author)->firstname }} {{ optional($author)->lastname }}</strong>
                                    <span>{{ ucfirst(optional($author)->role ?? 'user') }} &middot; {{ $message->created_at->format('M j, g:i A') }}</span>
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
                <form id="messageForm" action="{{ route('teacher.blog.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label for="messageInput">Message</label>
                        <textarea id="messageInput" name="message" rows="7" maxlength="500" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="ui-btn ui-btn-primary" id="sendButton">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                    <div class="live-status" id="liveStatus">Live updates on</div>
                </form>
            </aside>
        </div>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
<script>
(function () {
    const list = document.getElementById("messageList");
    const form = document.getElementById("messageForm");
    const input = document.getElementById("messageInput");
    const sendButton = document.getElementById("sendButton");
    const count = document.getElementById("messageCount");
    const participantCount = document.getElementById("participantCount");
    const liveStatus = document.getElementById("liveStatus");
    const token = form.querySelector("input[name=_token]").value;
    const currentUser = Number(list.dataset.currentUser || 0);
    const users = new Set(Array.from(list.querySelectorAll("[data-user-id]")).map((item) => item.dataset.userId));

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, (char) => ({
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#039;"
        }[char]));
    }

    function formatDate(value) {
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) return "Just now";
        return date.toLocaleString([], { month: "short", day: "numeric", hour: "numeric", minute: "2-digit" });
    }

    function initials(user) {
        return `${(user.firstname || "U").charAt(0)}${(user.lastname || "").charAt(0)}`.toUpperCase();
    }

    function addMessage(message) {
        if (document.querySelector(`[data-message-id="${message.id}"]`)) return;
        document.getElementById("emptyState")?.remove();

        const user = message.user || {};
        const author = `${user.firstname || ""} ${user.lastname || ""}`.trim() || "User";
        const own = Number(user.id) === currentUser ? " mine" : "";
        const role = user.role ? `${user.role.charAt(0).toUpperCase()}${user.role.slice(1)}` : "User";
        const item = document.createElement("article");
        item.className = `message-item${own}`;
        item.dataset.messageId = message.id;
        item.dataset.userId = user.id || "";
        item.innerHTML = `
            <div class="avatar">${escapeHtml(initials(user))}</div>
            <div class="message-body">
                <div class="message-meta">
                    <strong>${escapeHtml(author)}</strong>
                    <span>${escapeHtml(role)} &middot; ${escapeHtml(formatDate(message.created_at))}</span>
                </div>
                <p>${escapeHtml(message.message)}</p>
            </div>
        `;
        list.appendChild(item);
        list.dataset.lastId = Math.max(Number(list.dataset.lastId || 0), Number(message.id));
        if (user.id) users.add(String(user.id));
        count.textContent = `${list.querySelectorAll(".message-item").length} messages`;
        participantCount.textContent = `${users.size} participants`;
        list.scrollTop = list.scrollHeight;
    }

    async function loadMessages() {
        const url = new URL("{{ route('teacher.blog') }}", window.location.origin);
        url.searchParams.set("after", list.dataset.lastId || 0);
        try {
            const response = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest", "Accept": "application/json" } });
            if (!response.ok) throw new Error("refresh");
            const data = await response.json();
            (data.messages || []).forEach(addMessage);
            liveStatus.textContent = "Live updates on";
        } catch (error) {
            liveStatus.textContent = "Live updates reconnecting";
        }
    }

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        sendButton.disabled = true;

        try {
            const body = new FormData();
            body.append("_token", token);
            body.append("message", message);
            const response = await fetch(form.action, {
                method: "POST",
                headers: { "Accept": "application/json", "X-Requested-With": "XMLHttpRequest" },
                body
            });
            const data = await response.json();
            if (!response.ok || !data.success) throw new Error("send");
            if (data.message) addMessage(data.message);
            input.value = "";
            input.focus();
        } catch (error) {
            liveStatus.textContent = "Message not sent. Try again.";
        } finally {
            sendButton.disabled = false;
        }
    });

    list.scrollTop = list.scrollHeight;
    setInterval(loadMessages, 3000);
})();
</script>
@endsection
