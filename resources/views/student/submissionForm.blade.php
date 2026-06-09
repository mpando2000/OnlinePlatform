@extends('components.dashmaster')

@section('body')
@php
    $deadline = $assignment->submission_deadline;
    $isOverdue = $deadline && $deadline->isPast();
@endphp

<div class="content-wrapper student-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-upload"></i> Submit Assignment</h1>
                <p>{{ $assignment->title }}</p>
            </div>
            <a href="{{ route('student.assignment.show', $assignment->id) }}" class="ui-btn ui-btn-light">
                <i class="fas fa-arrow-left"></i> Details
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger panel-alert">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger panel-alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="panel-card form-card">
            <div class="detail-list">
                <div class="detail-row">
                    <span>Subject</span>
                    <strong>{{ optional($assignment->subject)->name ?? 'N/A' }}</strong>
                </div>
                <div class="detail-row">
                    <span>Deadline</span>
                    <strong>{{ $deadline ? $deadline->format('M j, Y g:i A') : 'No deadline' }}</strong>
                </div>
            </div>
        </section>

        @if($isOverdue)
            <section class="panel-card empty-state">
                <i class="fas fa-exclamation-circle"></i>
                <h3>Deadline passed</h3>
                <p>This assignment can no longer be submitted from the portal.</p>
                <a href="{{ route('student.assignments') }}" class="ui-btn ui-btn-light">
                    <i class="fas fa-arrow-left"></i> Back to Assignments
                </a>
            </section>
        @else
            <section class="panel-card form-card">
                <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <label for="file">Submission File</label>
                        <input id="file" type="file" name="file" accept=".pdf,.doc,.docx" required>
                        <span class="field-help">Accepted formats: PDF, DOC, DOCX.</span>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="ui-btn ui-btn-primary">
                            <i class="fas fa-upload"></i> Submit Assignment
                        </button>
                        <a href="{{ route('student.assignments') }}" class="ui-btn ui-btn-light">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </section>
        @endif
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('student.partials.clean-styles')
@endsection
