@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-plus"></i> Add Assignment</h1>
                <p>Upload an assignment for a class and subject.</p>
            </div>
            <a href="{{ route('teacher.assignments') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Assignments</a>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <section class="panel-card form-card">
            <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label>Class</label>
                        <select name="class_id" id="class_id" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Subject</label>
                        <select name="subject_id" id="subject_id" required>
                            <option value="">Select class first</option>
                        </select>
                    </div>
                    <div class="field field-wide">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="field field-wide">
                        <label>Description</label>
                        <textarea name="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="field">
                        <label>Assignment File</label>
                        <input type="file" name="file" required>
                    </div>
                    <div class="field">
                        <label>Submission Deadline</label>
                        <input type="datetime-local" name="submission_deadline" value="{{ old('submission_deadline') }}" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Assignment</button>
                    <a href="{{ route('teacher.assignments') }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </section>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
<script>
document.getElementById('class_id').addEventListener('change', async function() {
    const subject = document.getElementById('subject_id');
    subject.innerHTML = '<option value="">Loading...</option>';
    if (!this.value) {
        subject.innerHTML = '<option value="">Select class first</option>';
        return;
    }
    try {
        const response = await fetch('/teacher/get-subjects/' + this.value, { headers: { 'Accept': 'application/json' } });
        const subjects = await response.json();
        subject.innerHTML = '<option value="">Select Subject</option>';
        subjects.forEach(function(item) {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            subject.appendChild(option);
        });
    } catch (error) {
        subject.innerHTML = '<option value="">Unable to load subjects</option>';
    }
});
</script>
@endsection
