@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-school"></i> My Classes</h1>
                <p>Classes assigned to you.</p>
            </div>
            <a href="{{ route('teacher.dashboard') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Dashboard</a>
        </div>
        <section class="panel-card">
            <div class="panel-title"><strong>Classes</strong><span>{{ $schoolClasses->count() }} classes</span></div>
            <div class="item-grid">
                @forelse($schoolClasses as $schoolClass)
                    <a href="/teacher/viewClass/{{ $schoolClass->id }}" class="item-card">
                        <i class="fas fa-graduation-cap"></i>
                        <div><strong>{{ $schoolClass->name }}</strong><span>Open class subjects</span></div>
                    </a>
                @empty
                    <div class="empty-state">No classes assigned yet.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
@endsection
