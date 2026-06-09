@extends('components.dashmaster')

@section('body')
<div class="content-wrapper dashboard-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chalkboard-teacher"></i> Teacher Dashboard</h1>
                <p>Simple overview of your classes, students, assignments, and quizzes.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('teacher.classes') }}" class="ui-btn ui-btn-primary"><i class="fas fa-school"></i> Classes</a>
                <a href="{{ route('teacher.assignments') }}" class="ui-btn ui-btn-light"><i class="fas fa-tasks"></i> Assignments</a>
            </div>
        </div>

        <div class="stats-grid">
            <a href="{{ route('teacher.classes') }}" class="stat-card">
                <i class="fas fa-book"></i>
                <div><strong>{{ $totalSubjects }}</strong><span>Subjects</span></div>
            </a>
            <a href="{{ route('teacher.assignments') }}" class="stat-card">
                <i class="fas fa-tasks"></i>
                <div><strong>{{ $totalAssignments }}</strong><span>Active Assignments</span></div>
            </a>
            <a href="{{ route('teacher.classes') }}" class="stat-card">
                <i class="fas fa-users"></i>
                <div><strong>{{ $totalStudents }}</strong><span>Students</span></div>
            </a>
            <a href="{{ route('quizzes.index') }}" class="stat-card">
                <i class="fas fa-question-circle"></i>
                <div><strong>{{ $totalQuizzes }}</strong><span>Quizzes</span></div>
            </a>
        </div>

        <div class="dashboard-grid">
            <section class="panel-card">
                <div class="panel-title">
                    <strong>My Classes</strong>
                    <span>{{ $classes->count() }} classes</span>
                </div>
                <div class="list-panel">
                    @forelse($classes as $class)
                        <a href="/teacher/viewClass/{{ $class->id }}" class="list-row">
                            <div>
                                <strong>{{ $class->name }}</strong>
                                <span>{{ $class->subjects->count() ?? 0 }} subjects</span>
                            </div>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @empty
                        <div class="empty-state">No classes assigned yet.</div>
                    @endforelse
                </div>
            </section>

            <section class="panel-card">
                <div class="panel-title">
                    <strong>Student Summary</strong>
                    <span>{{ $recentSubmissions }} recent submissions</span>
                </div>
                <div class="summary-list">
                    @forelse($schoolStats as $school)
                        <div class="summary-row">
                            <span>{{ $school['name'] }}</span>
                            <strong>{{ $school['count'] }}</strong>
                        </div>
                    @empty
                        <div class="empty-state">No assigned students found.</div>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="panel-card">
            <div class="panel-title"><strong>Quick Actions</strong></div>
            <div class="actions-grid">
                <a href="{{ route('teacher.classes') }}" class="action-tile"><i class="fas fa-school"></i><span>Classes</span></a>
                <a href="{{ route('teacher.assignments') }}" class="action-tile"><i class="fas fa-clipboard-list"></i><span>Assignments</span></a>
                <a href="{{ route('quizzes.index') }}" class="action-tile"><i class="fas fa-question"></i><span>Quizzes</span></a>
                <a href="{{ route('teacher.blog') }}" class="action-tile"><i class="fas fa-comments"></i><span>Blog</span></a>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('partials.dashboard-clean-styles')
@endsection
