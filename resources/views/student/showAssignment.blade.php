@extends('components.dashmaster')

@section('body')
@php
    $deadline = $assignment->submission_deadline;
    $isOverdue = $deadline && $deadline->isPast();
    $isDueSoon = $deadline && $deadline->isFuture() && $deadline->lte(now()->addDays(3));
    $statusText = $isOverdue ? 'Overdue' : ($isDueSoon ? 'Due soon' : 'Active');
@endphp

<div class="content-wrapper student-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-file-alt"></i> Assignment Details</h1>
                <p>{{ $assignment->title }}</p>
            </div>
            <div class="row-actions">
                <a href="{{ route('student.assignments') }}" class="ui-btn ui-btn-light">
                    <i class="fas fa-arrow-left"></i> Assignments
                </a>
                <a href="{{ route('student.assignment.form', $assignment->id) }}" class="ui-btn ui-btn-primary">
                    <i class="fas fa-upload"></i> Submit
                </a>
            </div>
        </div>

        <div class="detail-layout">
            <section class="panel-card form-card">
                <div class="panel-title">
                    <strong>{{ $assignment->title }}</strong>
                    <span class="status-pill {{ $isOverdue ? 'danger' : ($isDueSoon ? 'warning' : '') }}">{{ $statusText }}</span>
                </div>
                <div class="detail-list">
                    <div class="detail-row">
                        <span>Subject</span>
                        <strong>{{ optional($assignment->subject)->name ?? 'N/A' }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Class</span>
                        <strong>{{ optional($assignment->schoolClass)->name ?? 'N/A' }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Teacher</span>
                        <strong>{{ optional($assignment->teacher)->name ?? 'Teacher' }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Deadline</span>
                        <strong>{{ $deadline ? $deadline->format('M j, Y g:i A') : 'No deadline' }}</strong>
                    </div>
                </div>
            </section>

            <section class="panel-card form-card">
                <div class="panel-title"><strong>Description</strong></div>
                <div class="description-box">
                    {!! $assignment->description ? nl2br(e($assignment->description)) : 'No description provided.' !!}
                </div>
                <div class="form-actions">
                    <a href="{{ route('student.assignment.open', $assignment->id) }}" target="_blank" class="ui-btn ui-btn-light">
                        <i class="fas fa-eye"></i> View File
                    </a>
                    <a href="{{ route('student.assignments.download', $assignment->id) }}" class="ui-btn ui-btn-light">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <a href="{{ route('student.assignment.form', $assignment->id) }}" class="ui-btn ui-btn-primary">
                        <i class="fas fa-upload"></i> Submit Work
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('student.partials.clean-styles')
@endsection
