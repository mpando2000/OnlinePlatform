@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-clipboard-check"></i> Assignment Submissions</h1>
                <p>Review student submissions for your assignments.</p>
            </div>
            <a href="{{ route('teacher.assignments') }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Assignments
            </a>
        </div>

        <div class="activity-stack">
            @forelse($assignmentsWithSubmissions as $assignment)
                <section class="panel-card table-card activity-panel">
                    <div class="panel-title activity-title">
                        <div>
                            <strong>{{ $assignment->title }}</strong>
                            <span>
                                {{ optional($assignment->schoolClass)->name ?? 'Class N/A' }}
                                @if($assignment->submission_deadline)
                                    · Deadline {{ $assignment->submission_deadline->format('M d, Y') }}
                                @endif
                            </span>
                        </div>
                        <span class="count-pill">{{ $assignment->submissions->count() }} submissions</span>
                    </div>

                    <div class="table-responsive">
                        <table class="clean-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Submitted</th>
                                    <th>Grade</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assignment->submissions as $submission)
                                    @php
                                        $studentName = trim(($submission->student->firstname ?? '') . ' ' . ($submission->student->lastname ?? '')) ?: ($submission->student->name ?? 'Student');
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $studentName }}</strong><span>{{ optional($submission->student)->email ?? 'No email' }}</span></td>
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
                                    <tr><td colspan="4" class="empty-cell">No submissions yet for this activity.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            @empty
                <section class="panel-card empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>No activities found</h3>
                    <p>Your assignments will appear here when created.</p>
                </section>
            @endforelse
        </div>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
