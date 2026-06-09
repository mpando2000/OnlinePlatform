@extends('components.dashmaster')

@section('body')
@php
    $active = $quizzes->filter(fn($quiz) => $quiz->start_time <= now() && $quiz->end_time >= now())->count();
    $upcoming = $quizzes->filter(fn($quiz) => $quiz->start_time > now())->count();
    $ended = $quizzes->filter(fn($quiz) => $quiz->end_time < now())->count();
@endphp

<div class="content-wrapper student-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-question-circle"></i> Quizzes</h1>
                <p>Take available quizzes for your class.</p>
            </div>
            <span class="count-pill">{{ $quizzes->count() }} quizzes</span>
        </div>

        @if(session('error'))
            <div class="alert alert-danger panel-alert">{{ session('error') }}</div>
        @endif

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-list"></i><div><strong>{{ $quizzes->count() }}</strong><span>Total</span></div></article>
            <article class="stat-card"><i class="fas fa-play"></i><div><strong>{{ $active }}</strong><span>Available</span></div></article>
            <article class="stat-card"><i class="fas fa-clock"></i><div><strong>{{ $upcoming }}</strong><span>Upcoming</span></div></article>
            <article class="stat-card"><i class="fas fa-check"></i><div><strong>{{ $ended }}</strong><span>Ended</span></div></article>
        </section>

        <section class="panel-card">
            <div class="panel-title"><strong>Quiz List</strong><span>{{ $quizzes->count() }} total</span></div>
            <div class="item-list">
                @forelse($quizzes as $quiz)
                    @php
                        $isActive = $quiz->start_time <= now() && $quiz->end_time >= now();
                        $isUpcoming = $quiz->start_time > now();
                        $status = $isActive ? 'Available' : ($isUpcoming ? 'Upcoming' : 'Ended');
                    @endphp
                    <article class="list-card assignment-row">
                        <i class="fas fa-question"></i>
                        <div class="list-main">
                            <strong>{{ $quiz->title }}</strong>
                            <span>{{ optional($quiz->subject)->name ?? 'Subject N/A' }} · {{ $quiz->duration }} minutes</span>
                            <span>{{ \Illuminate\Support\Str::limit($quiz->description, 90) }}</span>
                        </div>
                        <div class="assignment-meta">
                            <span class="status-pill {{ $isActive ? '' : ($isUpcoming ? 'warning' : 'danger') }}">{{ $status }}</span>
                            <small>{{ optional($quiz->start_time)->format('M j, g:i A') }}</small>
                        </div>
                        <div class="row-actions">
                            @if($isActive)
                                <a href="{{ route('quizzes.start', $quiz->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-play"></i> Start</a>
                            @elseif($isUpcoming)
                                <span class="ui-btn ui-btn-light"><i class="fas fa-clock"></i> Not Started</span>
                            @else
                                <span class="ui-btn ui-btn-light"><i class="fas fa-lock"></i> Closed</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-question-circle"></i>
                        <h3>No quizzes</h3>
                        <p>Available quizzes will appear here.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('student.partials.clean-styles')
@endsection
