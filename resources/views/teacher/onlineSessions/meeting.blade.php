@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-video"></i> Meeting Ready</h1>
                <p>Share the code or open the meeting link.</p>
            </div>
            <a href="{{ route('teacher.onlineSessions') }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <section class="panel-card form-card">
            <div class="detail-list">
                <div class="detail-row">
                    <span>Meeting Code</span>
                    <strong id="meetingCode">{{ $meeting->meeting_code }}</strong>
                </div>
                <div class="detail-row">
                    <span>Meeting Link</span>
                    <input id="meetingUrl" type="text" value="{{ $meeting->meeting_url }}" readonly>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ $meeting->meeting_url }}" target="_blank" class="ui-btn ui-btn-primary">
                    <i class="fas fa-external-link-alt"></i> Open Meeting
                </a>
                <button type="button" class="ui-btn ui-btn-soft" onclick="copyMeeting('meetingCode')">
                    <i class="fas fa-copy"></i> Copy Code
                </button>
                <button type="button" class="ui-btn ui-btn-soft" onclick="copyMeeting('meetingUrl')">
                    <i class="fas fa-link"></i> Copy Link
                </button>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
<script>
function copyMeeting(id) {
    const item = document.getElementById(id);
    const text = item.value || item.textContent.trim();
    navigator.clipboard.writeText(text);
}
</script>
@endsection
