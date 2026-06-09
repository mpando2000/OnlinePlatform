@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-tasks"></i> {{ $assignment->title }}</h1>
                <p>{{ optional($assignment->schoolClass)->name ?? 'Class' }} • {{ optional($assignment->subject)->name ?? 'Subject' }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('teacher.assignment.open', $assignment->id) }}" target="_blank" class="ui-btn ui-btn-primary">
                    <i class="fas fa-eye"></i> View Document
                </a>
                <a href="{{ route('teacher.assignments') }}" class="ui-btn ui-btn-soft">
                    <i class="fas fa-arrow-left"></i> Assignments
                </a>
            </div>
        </div>

        <section class="stats-grid">
            <article class="stat-card"><span>Total</span><strong>{{ $assignment->submissions_count ?? $assignment->submissions->count() }}</strong></article>
            <article class="stat-card"><span>Pending</span><strong>{{ $assignment->pending_count ?? 0 }}</strong></article>
            <article class="stat-card"><span>Graded</span><strong>{{ $assignment->graded_count ?? 0 }}</strong></article>
        </section>

        <section class="panel-card form-card">
            <div class="detail-list">
                <div class="detail-row">
                    <span>Deadline</span>
                    <strong>{{ optional($assignment->submission_deadline)->format('M d, Y h:i A') }}</strong>
                </div>
                <div class="detail-row">
                    <span>Description</span>
                    <strong>{{ $assignment->description ?: 'No description provided' }}</strong>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('teacher.assignment.open', $assignment->id) }}" target="_blank" class="ui-btn ui-btn-primary">
                    <i class="fas fa-eye"></i> View Assignment Document
                </a>
            </div>
        </section>

        <section class="panel-card table-card">
            <div class="card-heading">
                <h2><i class="fas fa-inbox"></i> Submissions</h2>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Submitted</th>
                            <th>Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignment->submissions as $submission)
                            @php
                                $studentName = trim(($submission->student->firstname ?? '') . ' ' . ($submission->student->lastname ?? '')) ?: ($submission->student->name ?? 'Student');
                            @endphp
                            <tr>
                                <td>{{ $studentName }}</td>
                                <td>{{ optional($submission->submitted_at)->format('M d, Y h:i A') ?? $submission->created_at->diffForHumans() }}</td>
                                <td><span class="status-pill">{{ $submission->grade ? $submission->grade . '%' : 'Pending' }}</span></td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('submission.show', $submission->id) }}" target="_blank" class="icon-btn" title="View submission">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('submission.download', $submission->id) }}" class="icon-btn" title="Download submission">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-cell">No submissions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
