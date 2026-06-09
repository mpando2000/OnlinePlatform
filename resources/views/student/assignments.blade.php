@extends('components.dashmaster')

@section('body')
@php
    $activeCount = $assignments->filter(fn($assignment) => $assignment->submission_deadline && $assignment->submission_deadline->isFuture())->count();
    $overdueCount = $assignments->filter(fn($assignment) => $assignment->submission_deadline && $assignment->submission_deadline->isPast())->count();
    $dueSoonCount = $assignments->filter(fn($assignment) => $assignment->submission_deadline && $assignment->submission_deadline->isFuture() && $assignment->submission_deadline->lte(now()->addDays(3)))->count();
@endphp

<div class="content-wrapper student-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-tasks"></i> Assignments</h1>
                <p>View, download, and submit your class assignments.</p>
            </div>
            <span class="count-pill">{{ $assignments->count() }} assignments</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger panel-alert">{{ session('error') }}</div>
        @endif

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-list"></i><div><strong>{{ $assignments->count() }}</strong><span>Total</span></div></article>
            <article class="stat-card"><i class="fas fa-check-circle"></i><div><strong>{{ $activeCount }}</strong><span>Active</span></div></article>
            <article class="stat-card"><i class="fas fa-clock"></i><div><strong>{{ $dueSoonCount }}</strong><span>Due Soon</span></div></article>
            <article class="stat-card"><i class="fas fa-exclamation-circle"></i><div><strong>{{ $overdueCount }}</strong><span>Overdue</span></div></article>
        </section>

        <section class="panel-card">
            <div class="panel-title">
                <strong>Assignment List</strong>
                <span>{{ $assignments->count() }} total</span>
            </div>
            <div class="item-list">
                @forelse($assignments as $assignment)
                    @php
                        $deadline = $assignment->submission_deadline;
                        $isOverdue = $deadline && $deadline->isPast();
                        $isDueSoon = $deadline && $deadline->isFuture() && $deadline->lte(now()->addDays(3));
                        $statusText = $isOverdue ? 'Overdue' : ($isDueSoon ? 'Due soon' : 'Active');
                    @endphp
                    <article class="list-card assignment-row">
                        <i class="fas fa-file-alt"></i>
                        <div class="list-main">
                            <strong>{{ $assignment->title }}</strong>
                            <span>{{ optional($assignment->subject)->name ?? 'Subject N/A' }} · {{ optional($assignment->schoolClass)->name ?? 'Class N/A' }}</span>
                            @if($assignment->description)
                                <span>{{ \Illuminate\Support\Str::limit($assignment->description, 90) }}</span>
                            @endif
                        </div>
                        <div class="assignment-meta">
                            <span class="status-pill {{ $isOverdue ? 'danger' : ($isDueSoon ? 'warning' : '') }}">{{ $statusText }}</span>
                            <small>{{ $deadline ? $deadline->format('M j, Y') : 'No deadline' }}</small>
                        </div>
                        <div class="row-actions">
                            <a href="{{ route('student.assignment.show', $assignment->id) }}" class="ui-btn ui-btn-light"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('student.assignments.download', $assignment->id) }}" class="ui-btn ui-btn-light"><i class="fas fa-download"></i> File</a>
                            <a href="{{ route('student.assignment.form', $assignment->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-upload"></i> Submit</a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-tasks"></i>
                        <h3>No assignments</h3>
                        <p>Your class assignments will appear here.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('student.partials.clean-styles')
@endsection
