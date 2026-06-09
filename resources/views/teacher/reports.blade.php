@extends('components.dashmaster')

@section('body')
@php
    $students = $users->where('role', 'student')->count();
    $teachers = $users->where('role', 'teacher')->count();
    $activeUsers = $users->where('status', 'active')->count();
@endphp

<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chart-pie"></i> Reports</h1>
                <p>Open user and class reports for review or printing.</p>
            </div>
            <a href="{{ route('teacher.dashboard') }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        </div>

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-users"></i><div><strong>{{ $users->count() }}</strong><span>Total Users</span></div></article>
            <article class="stat-card"><i class="fas fa-user-graduate"></i><div><strong>{{ $students }}</strong><span>Students</span></div></article>
            <article class="stat-card"><i class="fas fa-chalkboard-teacher"></i><div><strong>{{ $teachers }}</strong><span>Teachers</span></div></article>
            <article class="stat-card"><i class="fas fa-check-circle"></i><div><strong>{{ $activeUsers }}</strong><span>Active</span></div></article>
        </section>

        <section class="panel-card">
            <div class="panel-title">
                <strong>Available Reports</strong>
                <span>Teacher tools</span>
            </div>
            <div class="item-grid">
                <a href="{{ route('teacher.user.reports') }}" class="item-card report-tile">
                    <div class="item-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <h3>User Report</h3>
                        <p>View students and teachers in one report.</p>
                    </div>
                    <span class="ui-btn ui-btn-primary">Open</span>
                </a>
                <a href="{{ route('teacher.reportPrint') }}" class="item-card report-tile" target="_blank">
                    <div class="item-icon"><i class="fas fa-print"></i></div>
                    <div>
                        <h3>Print User Report</h3>
                        <p>Open a print-ready user report.</p>
                    </div>
                    <span class="ui-btn ui-btn-soft">Print</span>
                </a>
                <a href="{{ route('teacher.class.reports') }}" class="item-card report-tile">
                    <div class="item-icon"><i class="fas fa-school"></i></div>
                    <div>
                        <h3>Class Report</h3>
                        <p>Review class information and details.</p>
                    </div>
                    <span class="ui-btn ui-btn-primary">Open</span>
                </a>
                <a href="{{ route('teacher.classPrint') }}" class="item-card report-tile" target="_blank">
                    <div class="item-icon"><i class="fas fa-file-pdf"></i></div>
                    <div>
                        <h3>Print Class Report</h3>
                        <p>Open a print-ready class report.</p>
                    </div>
                    <span class="ui-btn ui-btn-soft">Print</span>
                </a>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
