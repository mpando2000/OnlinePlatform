@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-book"></i> {{ $school_class->name }}</h1>
                <p>Subjects assigned to you in this class.</p>
            </div>
            <a href="{{ route('teacher.classes') }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Classes
            </a>
        </div>

        <section class="item-grid">
            @forelse($subjects as $subject)
                <article class="panel-card item-card">
                    <div class="item-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div>
                        <h3>{{ $subject->name }}</h3>
                        <p>Teaching materials and class resources.</p>
                    </div>
                    <a href="{{ route('teacher.subjects', ['class' => $school_class->id, 'subject' => $subject->id]) }}" class="ui-btn ui-btn-primary">
                        <i class="fas fa-folder-open"></i> Materials
                    </a>
                </article>
            @empty
                <section class="panel-card empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>No subjects assigned</h3>
                    <p>Subjects assigned to you will appear here.</p>
                </section>
            @endforelse
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
