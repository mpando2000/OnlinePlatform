@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-plus"></i> Create Quiz</h1>
                <p>Add quiz details and questions.</p>
            </div>
            <a href="{{ route('quizzes.index') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Quizzes</a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger panel-alert">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger panel-alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        @endif

        <section class="panel-card form-card">
            <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data" id="quizForm">
                @csrf
                <input type="hidden" name="quiz_type" value="questions">
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
                    <div class="field"><label>Subject</label><select id="subject_id" name="subject_id" required><option value="">Select subject</option></select></div>
                    <div class="field"><label>Start Time</label><input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required></div>
                    <div class="field"><label>End Time</label><input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required></div>
                    <div class="field"><label>Duration (minutes)</label><input type="number" name="duration" min="1" value="{{ old('duration', 30) }}" required></div>
                </div>

                <div class="panel-title quiz-question-title"><strong>Questions</strong><button type="button" class="ui-btn ui-btn-soft" id="addQuestion"><i class="fas fa-plus"></i> Add</button></div>
                <div id="questions">
                    <div class="question-box" data-index="0">
                        <div class="field"><label>Question</label><textarea name="questions[0][question_text]" rows="2" required></textarea></div>
                        <div class="form-grid">
                            <div class="field"><label>Option A</label><input name="questions[0][option_a]" required></div>
                            <div class="field"><label>Option B</label><input name="questions[0][option_b]" required></div>
                            <div class="field"><label>Option C</label><input name="questions[0][option_c]" required></div>
                            <div class="field"><label>Option D</label><input name="questions[0][option_d]" required></div>
                            <div class="field"><label>Correct Answer</label><select name="questions[0][correct_answer]" required><option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option></select></div>
                        </div>
                    </div>
                </div>

                <div class="form-actions"><button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Quiz</button></div>
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
    if (!this.value) return subject.innerHTML = '<option value="">Select subject</option>';
    const response = await fetch(`/teacher/get-subjects/${this.value}`);
    const subjects = await response.json();
    subject.innerHTML = '<option value="">Select subject</option>';
    subjects.forEach((item) => subject.insertAdjacentHTML("beforeend", `<option value="${item.id}">${item.name}</option>`));
});
document.getElementById("addQuestion").addEventListener("click", () => {
    const wrap = document.getElementById("questions");
    const index = wrap.children.length;
    wrap.insertAdjacentHTML("beforeend", `
        <div class="question-box" data-index="${index}">
            <div class="field"><label>Question</label><textarea name="questions[${index}][question_text]" rows="2" required></textarea></div>
            <div class="form-grid">
                <div class="field"><label>Option A</label><input name="questions[${index}][option_a]" required></div>
                <div class="field"><label>Option B</label><input name="questions[${index}][option_b]" required></div>
                <div class="field"><label>Option C</label><input name="questions[${index}][option_c]" required></div>
                <div class="field"><label>Option D</label><input name="questions[${index}][option_d]" required></div>
                <div class="field"><label>Correct Answer</label><select name="questions[${index}][correct_answer]" required><option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option></select></div>
            </div>
        </div>`);
});
</script>
@endsection
