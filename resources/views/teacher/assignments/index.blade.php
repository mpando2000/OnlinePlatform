@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-clipboard-list"></i> Assignments</h1>
                <p>Create and manage your class assignments.</p>
            </div>
            <div class="page-actions">
                <a href="/addAssignment" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Add Assignment</a>
                <a href="{{ route('teacher.assignments.submissions') }}" class="ui-btn ui-btn-light"><i class="fas fa-inbox"></i> Submissions</a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <section class="panel-card">
            <div class="panel-title"><strong>Assignment List</strong><span>{{ $assignments->count() }} assignments</span></div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead><tr><th>Assignment</th><th>Class</th><th>Subject</th><th>Deadline</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td><strong>{{ $assignment->title }}</strong><span>{{ Str::limit($assignment->description, 70) }}</span></td>
                                <td>{{ optional($assignment->schoolClass)->name ?? 'N/A' }}</td>
                                <td>{{ optional($assignment->subject)->name ?? 'N/A' }}</td>
                                <td>{{ $assignment->submission_deadline ? \Carbon\Carbon::parse($assignment->submission_deadline)->format('M j, Y') : 'N/A' }}</td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('assignment.show', $assignment) }}" class="icon-btn"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('teacher.assignment.open', $assignment) }}" target="_blank" class="icon-btn"><i class="fas fa-file"></i></a>
                                        <form action="/deleteAssignment/{{ $assignment->id }}" method="POST" onsubmit="return confirm('Delete this assignment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-state">No assignments found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
@endsection
