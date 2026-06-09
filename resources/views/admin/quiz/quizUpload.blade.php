@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-upload"></i> Upload Quiz</h1>
                <p>Upload a quiz file and assign it to a class.</p>
            </div>
            <a href="{{ route('admin.quizzes.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Quizzes</a>
        </div>
        @include('admin.quiz.partials.errors')
        <form action="{{ route('admin.quizzes.upload.post') }}" method="POST" enctype="multipart/form-data" class="form-card">
            @csrf
            @include('admin.quiz.partials.quiz-fields', ['quiz' => null, 'classes' => $classes, 'subjects' => $subjects])
            <div class="field field-wide">
                <label>Quiz File</label>
                <input type="file" name="quiz_file" required>
            </div>
            <div class="form-actions">
                <button class="ui-btn ui-btn-primary" type="submit"><i class="fas fa-upload"></i> Upload Quiz</button>
            </div>
        </form>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.quiz.partials.clean-styles')
@endsection
