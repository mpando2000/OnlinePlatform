@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-upload"></i> Upload Quiz</h1>
                <p>Create a file-based quiz.</p>
            </div>
            <a href="{{ route('quizzes.index') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Quizzes</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger panel-alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        @endif

        <section class="panel-card form-card">
            <form action="{{ route('quizzes.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="field field-wide"><label>Title</label><input type="text" name="title" value="{{ old('title') }}" required></div>
                    <div class="field field-wide"><label>Description</label><textarea name="description" rows="3" required>{{ old('description') }}</textarea></div>
                    <div class="field">
                        <label>Class</label>
                        <select id="class_id" name="class_id" required>
                            <option value="">Select class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Subject</label>
                        <select id="subject_id" name="subject_id" required><option value="">Select subject</option></select>
                    </div>
                    <div class="field"><label>Start Time</label><input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required></div>
                    <div class="field"><label>End Time</label><input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required></div>
                    <div class="field"><label>Duration (minutes)</label><input type="number" name="duration" min="1" value="{{ old('duration', 30) }}" required></div>
                    <div class="field"><label>Quiz File</label><input type="file" name="quiz_file" accept=".pdf,.doc,.docx" required></div>
                </div>
                <div class="form-actions">
                    <button class="ui-btn ui-btn-primary" type="submit"><i class="fas fa-save"></i> Save Quiz</button>
                </div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
<script>
document.getElementById("class_id").addEventListener("change", async function () {
    const subject = document.getElementById("subject_id");
    subject.innerHTML = '<option value="">Loading...</option>';
    if (!this.value) {
        subject.innerHTML = '<option value="">Select subject</option>';
        return;
    }
    const response = await fetch(`/teacher/get-subjects/${this.value}`);
    const subjects = await response.json();
    subject.innerHTML = '<option value="">Select subject</option>';
    subjects.forEach((item) => subject.insertAdjacentHTML("beforeend", `<option value="${item.id}">${item.name}</option>`));
});
</script>
@endsection
