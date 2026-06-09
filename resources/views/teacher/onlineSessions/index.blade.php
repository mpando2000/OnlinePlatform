@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-video"></i> Online Sessions</h1>
                <p>Create or join online learning sessions.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('teacher.createMeeting') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Create Session</a>
                <a href="{{ route('teacher.joinOnlineSessions') }}" class="ui-btn ui-btn-light"><i class="fas fa-sign-in-alt"></i> Join Session</a>
            </div>
        </div>
        <section class="panel-card">
            <div class="panel-title"><strong>Session Actions</strong></div>
            <div class="item-grid">
                <a href="{{ route('teacher.createMeeting') }}" class="item-card"><i class="fas fa-video"></i><div><strong>Create Session</strong><span>Start a new meeting</span></div></a>
                <a href="{{ route('teacher.joinOnlineSessions') }}" class="item-card"><i class="fas fa-key"></i><div><strong>Join Session</strong><span>Enter meeting code</span></div></a>
            </div>
        </section>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
@endsection
