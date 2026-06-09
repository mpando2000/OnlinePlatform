@extends('components.dashmaster')

@section('body')
@php
    $active = $quizzes->filter(fn($quiz) => $quiz->start_time <= now() && $quiz->end_time >= now())->count();
    $upcoming = $quizzes->filter(fn($quiz) => $quiz->start_time > now())->count();
    $ended = $quizzes->filter(fn($quiz) => $quiz->end_time < now())->count();
@endphp

<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-question-circle"></i> Quizzes</h1>
                <p>Create and manage quizzes for your classes.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('quizzes.create') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Create</a>
                <a href="{{ route('quizzes.upload') }}" class="ui-btn ui-btn-soft"><i class="fas fa-upload"></i> Upload</a>
                <a href="{{ route('teacher.quizzes.results') }}" class="ui-btn ui-btn-soft"><i class="fas fa-chart-bar"></i> Results</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger panel-alert">{{ session('error') }}</div>
        @endif

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-list"></i><div><strong>{{ $quizzes->count() }}</strong><span>Total</span></div></article>
            <article class="stat-card"><i class="fas fa-play-circle"></i><div><strong>{{ $active }}</strong><span>Active</span></div></article>
            <article class="stat-card"><i class="fas fa-clock"></i><div><strong>{{ $upcoming }}</strong><span>Upcoming</span></div></article>
            <article class="stat-card"><i class="fas fa-check-circle"></i><div><strong>{{ $ended }}</strong><span>Ended</span></div></article>
        </section>

        <section class="panel-card table-card">
            <div class="panel-title"><strong>Quiz List</strong><span>{{ $quizzes->count() }} quizzes</span></div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Quiz</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Schedule</th>
                            <th>Duration</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                            @php
                                $isActive = $quiz->start_time <= now() && $quiz->end_time >= now();
                                $isUpcoming = $quiz->start_time > now();
                                $status = $isActive ? 'Active' : ($isUpcoming ? 'Upcoming' : 'Ended');
                            @endphp
                            <tr>
                                <td><strong>{{ $quiz->title }}</strong><span>{{ \Illuminate\Support\Str::limit($quiz->description, 70) }}</span></td>
                                <td>{{ optional($quiz->class)->name ?? 'N/A' }}</td>
                                <td>{{ optional($quiz->subject)->name ?? 'N/A' }}</td>
                                <td>{{ optional($quiz->start_time)->format('M j, g:i A') }}<span>{{ $status }}</span></td>
                                <td>{{ $quiz->duration }} min</td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="icon-btn" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('view.quizzes.results', $quiz->id) }}" class="icon-btn" title="Results"><i class="fas fa-chart-bar"></i></a>
                                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Delete this quiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn danger" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="empty-cell">No quizzes found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
@endsection
