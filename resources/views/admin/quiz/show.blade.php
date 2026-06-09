@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-question-circle"></i> {{ $quiz->title }}</h1>
                <p>{{ optional($quiz->class)->name ?? optional($quiz->schoolClass)->name ?? 'No class' }} · {{ optional($quiz->subject)->name ?? 'No subject' }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="ui-btn ui-btn-primary"><i class="fas fa-edit"></i> Edit</a>
                <a href="{{ route('admin.quizzes.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Quizzes</a>
            </div>
        </div>
        <section class="table-card">
            <div class="table-title"><strong>Details</strong><span>{{ $quiz->duration }} minutes</span></div>
            <div class="info-grid">
                <div class="info-item"><span>Start</span><strong>{{ $quiz->start_time ? \Carbon\Carbon::parse($quiz->start_time)->format('M j, Y g:i A') : 'N/A' }}</strong></div>
                <div class="info-item"><span>End</span><strong>{{ $quiz->end_time ? \Carbon\Carbon::parse($quiz->end_time)->format('M j, Y g:i A') : 'N/A' }}</strong></div>
                <div class="info-item"><span>Questions</span><strong>{{ $quiz->questions->count() }}</strong></div>
                <div class="info-item field-wide"><span>Description</span><strong>{{ $quiz->description }}</strong></div>
            </div>
        </section>
        <section class="table-card">
            <div class="table-title"><strong>Questions</strong></div>
            <div class="question-list">
                @forelse($quiz->questions as $question)
                    <article class="question-card">
                        <strong>{{ $loop->iteration }}. {{ $question->question_text }}</strong>
                        <span>Correct: {{ $question->correct_option }}</span>
                    </article>
                @empty
                    <div class="empty-state">This quiz uses an uploaded file or has no questions.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.quiz.partials.clean-styles')
@endsection
