@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-upload"></i> Upload Results</h1>
                <p>{{ $quiz->title }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.quizzes.downloadTemplate', $quiz) }}" class="ui-btn ui-btn-light"><i class="fas fa-file-download"></i> Template</a>
                <a href="{{ route('admin.quizzes.results', $quiz) }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Results</a>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.quizzes.uploadResults', $quiz) }}" method="POST" enctype="multipart/form-data" class="form-card">
            @csrf
            <div class="form-grid">
                <div class="field field-wide">
                    <label>Results File</label>
                    <input type="file" name="results" accept=".xlsx,.xls,.csv" required>
                </div>
            </div>
            <div class="form-actions">
                <button class="ui-btn ui-btn-primary" type="submit"><i class="fas fa-upload"></i> Upload Results</button>
                <a href="{{ route('admin.quizzes.results', $quiz) }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.quiz.partials.clean-styles')
@endsection
