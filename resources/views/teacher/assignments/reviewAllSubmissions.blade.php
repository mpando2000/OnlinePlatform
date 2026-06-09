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

        <section class="panel-card table-card">
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Assignment</th>
                            <th>Student</th>
                            <th>Submitted</th>
                            <th>Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignmentsWithSubmissions as $assignment)
                            @forelse($assignment->submissions as $submission)
                                @php
                                    $studentName = trim(($submission->student->firstname ?? '') . ' ' . ($submission->student->lastname ?? '')) ?: ($submission->student->name ?? 'Student');
                                @endphp
                                <tr>
                                    <td>{{ $assignment->title }}</td>
                                    <td>{{ $studentName }}</td>
                                    <td>{{ optional($submission->submitted_at)->format('M d, Y h:i A') ?? $submission->created_at->diffForHumans() }}</td>
                                    <td><span class="status-pill">{{ $submission->grade ? $submission->grade . '%' : 'Pending' }}</span></td>
                                    <td>
                                        <a href="{{ route('submission.download', $submission->id) }}" class="icon-btn" title="Download submission">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>{{ $assignment->title }}</td>
                                    <td colspan="4" class="empty-cell">No submissions yet.</td>
                                </tr>
                            @endforelse
                        @empty
                            <tr>
                                <td colspan="5" class="empty-cell">No assignments found.</td>
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
