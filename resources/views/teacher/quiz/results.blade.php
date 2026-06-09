@extends('components.dashmaster')

@section('body')
@php
    $total = $quizResults->count();
    $average = $total ? round($quizResults->avg('percentage'), 1) : 0;
    $highest = $total ? round($quizResults->max('percentage'), 1) : 0;
    $lowest = $total ? round($quizResults->min('percentage'), 1) : 0;
@endphp

<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chart-line"></i> {{ $quiz->title }}</h1>
                <p>Student quiz results and scores.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('quizzes.uploadResultsForm', $quiz->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-upload"></i> Upload Results</a>
                <a href="{{ route('teacher.quizzes.results') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Result List</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger panel-alert">{{ session('error') }}</div>
        @endif

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-users"></i><div><strong>{{ $total }}</strong><span>Students</span></div></article>
            <article class="stat-card"><i class="fas fa-percent"></i><div><strong>{{ $average }}%</strong><span>Average</span></div></article>
            <article class="stat-card"><i class="fas fa-arrow-up"></i><div><strong>{{ $highest }}%</strong><span>Highest</span></div></article>
            <article class="stat-card"><i class="fas fa-arrow-down"></i><div><strong>{{ $lowest }}%</strong><span>Lowest</span></div></article>
        </section>

        <section class="panel-card table-card">
            <div class="panel-title">
                <strong>Results</strong>
                <span>{{ $total }} entries</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Score</th>
                            <th>Total Questions</th>
                            <th>Percentage</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizResults as $result)
                            @php
                                $student = $result->student;
                                $studentName = $student ? ($student->name ?: trim(($student->firstname ?? '') . ' ' . ($student->lastname ?? ''))) : 'Student';
                                $percentage = round($result->percentage, 1);
                            @endphp
                            <tr>
                                <td><strong>{{ $studentName }}</strong><span>{{ optional($student)->email ?? 'No email' }}</span></td>
                                <td>{{ $result->score }}</td>
                                <td>{{ $result->total_questions }}</td>
                                <td><span class="status-pill {{ $percentage < 50 ? 'danger' : ($percentage < 70 ? 'warning' : '') }}">{{ $percentage }}%</span></td>
                                <td>{{ optional($result->created_at)->format('M j, Y g:i A') ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-cell">No results found for this quiz.</td></tr>
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
