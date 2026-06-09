@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-sign-in-alt"></i> Join Online Session</h1>
                <p>Enter the meeting code shared with you.</p>
            </div>
            <a href="{{ route('teacher.onlineSessions') }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger panel-alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="panel-card form-card">
            <form action="{{ route('teacher.joinMeeting') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="meeting_code">Meeting Code</label>
                    <input id="meeting_code" type="text" name="meeting_code" value="{{ old('meeting_code') }}" required autocomplete="off" autofocus>
                </div>

                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary">
                        <i class="fas fa-video"></i> Join Session
                    </button>
                </div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
