@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-question-circle"></i> Quizzes</h1>
                <p>Create, upload, edit, and review quizzes.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.quizzes.create') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Create Quiz</a>
                <a href="{{ route('admin.quizzes.upload') }}" class="ui-btn ui-btn-light"><i class="fas fa-upload"></i> Upload Quiz</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="stats-grid">
            <div class="stat-card"><span>Total</span><strong>{{ $quizzes->count() }}</strong></div>
            <div class="stat-card"><span>Active</span><strong>{{ $quizzes->where('start_time', '<=', now())->where('end_time', '>=', now())->count() }}</strong></div>
            <div class="stat-card"><span>Upcoming</span><strong>{{ $quizzes->where('start_time', '>', now())->count() }}</strong></div>
            <div class="stat-card"><span>Ended</span><strong>{{ $quizzes->where('end_time', '<', now())->count() }}</strong></div>
        </div>

        <div class="table-card">
            <div class="table-title"><strong>Quiz List</strong><span>{{ $quizzes->count() }} quizzes</span></div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead><tr><th>Quiz</th><th>Class</th><th>Schedule</th><th>Duration</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                            <tr>
                                <td><strong>{{ $quiz->title }}</strong><span>{{ Str::limit($quiz->description, 70) }}</span></td>
                                <td>{{ optional($quiz->class)->name ?? optional($quiz->schoolClass)->name ?? 'N/A' }}<span>{{ optional($quiz->subject)->name ?? 'No subject' }}</span></td>
                                <td>{{ $quiz->start_time ? \Carbon\Carbon::parse($quiz->start_time)->format('M j, g:i A') : 'N/A' }}<span>to {{ $quiz->end_time ? \Carbon\Carbon::parse($quiz->end_time)->format('M j, g:i A') : 'N/A' }}</span></td>
                                <td>{{ $quiz->duration }} min</td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('admin.quizzes.show', $quiz) }}" class="icon-btn" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.quizzes.results', $quiz) }}" class="icon-btn" title="Results"><i class="fas fa-chart-bar"></i></a>
                                        <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Delete this quiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-cell">No quizzes found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.quiz.partials.clean-styles')
@endsection
