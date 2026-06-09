@extends('components.dashmaster')

@section('body')
@php
    $subjectCount = $subjectCount ?? $classes->sum('subjects_count');
    $studentCount = $studentCount ?? 0;
@endphp

<div class="content-wrapper admin-report-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-school"></i> Class Report</h1>
                <p>Review classes and their basic academic information.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.classPrint') }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-print"></i> Print</a>
                <a href="{{ route('admin.report') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Reports</a>
            </div>
        </div>

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-school"></i><div><strong>{{ $classes->count() }}</strong><span>Classes</span></div></article>
            <article class="stat-card"><i class="fas fa-book"></i><div><strong>{{ $subjectCount }}</strong><span>Subjects</span></div></article>
            <article class="stat-card"><i class="fas fa-user-graduate"></i><div><strong>{{ $studentCount }}</strong><span>Students</span></div></article>
            <article class="stat-card"><i class="fas fa-calendar"></i><div><strong>{{ date('Y') }}</strong><span>Year</span></div></article>
        </section>

        <section class="table-card">
            <div class="panel-title">
                <strong>Classes</strong>
                <span>{{ $classes->count() }} records</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Subjects</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $class->name }}</strong><span>Academic class</span></td>
                                <td>{{ $class->subjects_count ?? optional($class->subjects ?? null)->count() ?? 'N/A' }}</td>
                                <td>{{ optional($class->created_at)->format('M d, Y') ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="empty-cell">No classes found.</td></tr>
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

@include('admin.partials.report-clean-styles')
@endsection
