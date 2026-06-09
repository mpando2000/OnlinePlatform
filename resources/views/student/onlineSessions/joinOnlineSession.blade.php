@extends('components.dashmaster')

@section('body')
<div class="content-wrapper student-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-video"></i> Online Session</h1>
                <p>Enter the meeting code from your teacher.</p>
            </div>
            <a href="{{ route('student.dashboard') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Dashboard</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="panel-card form-card">
            <form action="{{ route('student.joinMeeting') }}" method="POST">
                @csrf
                <div class="field">
                    <label>Meeting Code</label>
                    <input type="text" name="meeting_code" value="{{ old('meeting_code') }}" required autocomplete="off">
                </div>
                <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-sign-in-alt"></i> Join Session</button>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('student.partials.clean-styles')
@endsection
