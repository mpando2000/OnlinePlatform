@extends('components.dashmaster')

@section('body')
<div class="content-wrapper student-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-book-open"></i> My Subjects</h1>
                <p>{{ $student->schoolClass ? $student->schoolClass->name : 'No class assigned' }}</p>
            </div>
            <a href="{{ route('student.dashboard') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Dashboard</a>
        </div>

        @if($student->schoolClass)
            <div class="stats-grid">
                <div class="stat-card"><i class="fas fa-book"></i><div><strong>{{ $subjects->count() }}</strong><span>Subjects</span></div></div>
                <div class="stat-card"><i class="fas fa-users"></i><div><strong>{{ $student->schoolClass->name }}</strong><span>Class</span></div></div>
            </div>

            <section class="panel-card">
                <div class="panel-title">
                    <strong>Subjects</strong>
                    <span>{{ $subjects->count() }} total</span>
                </div>
                <div class="item-grid">
                    @forelse($subjects as $subject)
                        <a href="{{ route('student.subject.materials', $subject->id) }}" class="item-card">
                            <i class="fas fa-book"></i>
                            <div>
                                <strong>{{ $subject->name }}</strong>
                                <span>Open materials</span>
                            </div>
                        </a>
                    @empty
                        <div class="empty-state">No subjects assigned to your class yet.</div>
                    @endforelse
                </div>
            </section>
        @else
            <section class="panel-card">
                <div class="empty-state">You are not enrolled in any class. Please contact administration.</div>
            </section>
        @endif
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('student.partials.clean-styles')
@endsection
