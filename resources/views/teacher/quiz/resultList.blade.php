@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chart-bar"></i> Quiz Results</h1>
                <p>Select a quiz to view student results.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('quizzes.index') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Quizzes</a>
                <a href="{{ route('quizzes.create') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Create Quiz</a>
            </div>
        </div>

        <section class="panel-card table-card">
            <div class="panel-title">
                <strong>Quiz List</strong>
                <span>{{ $quizzes->count() }} quizzes</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Quiz</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Schedule</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                            <tr>
                                <td><strong>{{ $quiz->title }}</strong><span>{{ \Illuminate\Support\Str::limit($quiz->description, 70) }}</span></td>
                                <td>{{ optional($quiz->class)->name ?? 'N/A' }}</td>
                                <td>{{ optional($quiz->subject)->name ?? 'N/A' }}</td>
                                <td>{{ optional($quiz->start_time)->format('M j, Y') ?? 'N/A' }}</td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('view.quizzes.results', $quiz->id) }}" class="ui-btn ui-btn-primary">
                                            <i class="fas fa-chart-line"></i> View Results
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-cell">No quizzes found.</td></tr>
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
