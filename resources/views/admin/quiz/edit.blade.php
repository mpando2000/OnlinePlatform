@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-edit"></i> Edit Quiz</h1>
                <p>{{ $quiz->title }}</p>
            </div>
            <a href="{{ route('admin.quizzes.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Quizzes</a>
        </div>
        @include('admin.quiz.partials.errors')
        <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST" enctype="multipart/form-data" class="form-card" id="quizForm">
            @csrf
            @method('PUT')
            @include('admin.quiz.partials.quiz-fields', ['quiz' => $quiz, 'classes' => $classes, 'subjects' => $subjects])
            <div class="question-panel">
                <div class="table-title"><strong>Questions</strong><button type="button" class="ui-btn ui-btn-light" id="addQuestion"><i class="fas fa-plus"></i> Add Question</button></div>
                <div id="questions"></div>
            </div>
            <div class="form-actions">
                <button class="ui-btn ui-btn-primary" type="submit"><i class="fas fa-save"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.quiz.partials.clean-styles')
@include('admin.quiz.partials.question-script', ['questions' => $quiz->questions])
@endsection
