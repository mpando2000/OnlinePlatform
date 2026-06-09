@extends('components.dashmaster')

@section('body')
@php
    $status = $quiz->start_time > now() ? 'Upcoming' : ($quiz->end_time < now() ? 'Ended' : 'Active');
@endphp

<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-question-circle"></i> Quiz Details</h1>
                <p>{{ $quiz->title }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-edit"></i> Edit</a>
                <a href="{{ route('view.quizzes.results', $quiz->id) }}" class="ui-btn ui-btn-soft"><i class="fas fa-chart-bar"></i> Results</a>
                <a href="{{ route('quizzes.index') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Quizzes</a>
            </div>
        </div>

        <div class="detail-layout">
            <section class="panel-card form-card">
                <div class="panel-title"><strong>Information</strong><span>{{ $status }}</span></div>
                <div class="detail-list">
                    <div class="detail-row"><span>Class</span><strong>{{ optional($quiz->class)->name ?? 'N/A' }}</strong></div>
                    <div class="detail-row"><span>Subject</span><strong>{{ optional($quiz->subject)->name ?? 'N/A' }}</strong></div>
                    <div class="detail-row"><span>Starts</span><strong>{{ optional($quiz->start_time)->format('M j, Y g:i A') }}</strong></div>
                    <div class="detail-row"><span>Ends</span><strong>{{ optional($quiz->end_time)->format('M j, Y g:i A') }}</strong></div>
                    <div class="detail-row"><span>Duration</span><strong>{{ $quiz->duration }} minutes</strong></div>
                </div>
            </section>
            <section class="panel-card form-card">
                <div class="panel-title"><strong>Description</strong></div>
                <div class="description-box">{{ $quiz->description ?: 'No description provided.' }}</div>
                @if($quiz->quiz_file)
                    <div class="form-actions">
                        <a href="{{ route('quizzes.file', $quiz->id) }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-file"></i> Open File</a>
                    </div>
                @endif
            </section>
        </div>

        <section class="panel-card table-card profile-section">
            <div class="panel-title"><strong>Questions</strong><span>{{ $quiz->questions->count() }} total</span></div>
            <div class="item-list">
                @forelse($quiz->questions as $index => $question)
                    <article class="list-card quiz-question-card">
                        <i class="fas fa-question"></i>
                        <div class="list-main">
                            <strong>{{ $index + 1 }}. {{ $question->question_text }}</strong>
                            <span>A. {{ $question->option_a ?? $question->option1 }}</span>
                            <span>B. {{ $question->option_b ?? $question->option2 }}</span>
                            <span>C. {{ $question->option_c ?? $question->option3 }}</span>
                            <span>D. {{ $question->option_d ?? $question->option4 }}</span>
                            <span>Correct: {{ strtoupper($question->correct_answer ?? str_replace('option', '', $question->correct_option ?? '')) }}</span>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">No questions. This may be a file-based quiz.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
@endsection
