@extends('components.dashmaster')

@section('body')
<div class="content-wrapper dashboard-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
                <p>{{ $student->schoolClass ? $student->schoolClass->name : 'No class assigned' }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('student.class') }}" class="ui-btn ui-btn-primary"><i class="fas fa-book"></i> Subjects</a>
                <a href="{{ route('student.assignments') }}" class="ui-btn ui-btn-light"><i class="fas fa-tasks"></i> Assignments</a>
            </div>
        </div>

        <div class="stats-grid">
            <a href="{{ route('student.class') }}" class="stat-card">
                <i class="fas fa-book-open"></i>
                <div><strong>{{ $totalSubjects }}</strong><span>Subjects</span></div>
            </a>
            <a href="{{ route('student.assignments') }}" class="stat-card">
                <i class="fas fa-tasks"></i>
                <div><strong>{{ $totalAssignments }}</strong><span>Assignments</span></div>
            </a>
            <a href="{{ route('student.quizzes') }}" class="stat-card">
                <i class="fas fa-question-circle"></i>
                <div><strong>{{ $totalQuizzes }}</strong><span>Quizzes</span></div>
            </a>
            <a href="{{ route('student.blog') }}" class="stat-card">
                <i class="fas fa-comments"></i>
                <div><strong>{{ $recentActivities->count() }}</strong><span>Recent Activity</span></div>
            </a>
        </div>

        <div class="dashboard-grid">
            <section class="panel-card">
                <div class="panel-title">
                    <strong>Upcoming Work</strong>
                    <span>{{ $upcomingEvents->count() }} items</span>
                </div>
                <div class="list-panel">
                    @forelse($upcomingEvents as $event)
                        <div class="list-row">
                            <div>
                                <strong>{{ $event['title'] }}</strong>
                                <span>{{ $event['description'] }} · {{ $event['date']->format('M j, Y') }}</span>
                            </div>
                            <i class="fas {{ $event['type'] === 'assignment' ? 'fa-clipboard-list' : 'fa-question-circle' }}"></i>
                        </div>
                    @empty
                        <div class="empty-state">No upcoming assignments or quizzes.</div>
                    @endforelse
                </div>
            </section>

            <section class="panel-card">
                <div class="panel-title">
                    <strong>Study Progress</strong>
                    <span>{{ $studyProgress->count() }} subjects</span>
                </div>
                <div class="progress-list">
                    @forelse($studyProgress as $subject)
                        <div class="progress-row">
                            <div class="progress-meta">
                                <strong>{{ $subject['name'] }}</strong>
                                <span>{{ $subject['percentage'] }}%</span>
                            </div>
                            <div class="progress-track"><div style="width: {{ $subject['percentage'] }}%"></div></div>
                        </div>
                    @empty
                        <div class="empty-state">No subject progress available.</div>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="panel-card">
            <div class="panel-title"><strong>Quick Actions</strong></div>
            <div class="actions-grid">
                <a href="{{ route('student.class') }}" class="action-tile"><i class="fas fa-book-reader"></i><span>Materials</span></a>
                <a href="{{ route('student.assignments') }}" class="action-tile"><i class="fas fa-pencil-alt"></i><span>Assignments</span></a>
                <a href="{{ route('student.quizzes') }}" class="action-tile"><i class="fas fa-question"></i><span>Quizzes</span></a>
                <a href="{{ route('student.blog') }}" class="action-tile"><i class="fas fa-comments"></i><span>Discussion</span></a>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('partials.dashboard-clean-styles')
@endsection
