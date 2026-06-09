@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-edit"></i> Edit Quiz</h1>
                <p>{{ $quiz->title }}</p>
            </div>
            <a href="{{ route('quizzes.show', $quiz->id) }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Details</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger panel-alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        @endif

        <section class="panel-card form-card">
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST" enctype="multipart/form-data" id="quizForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="quiz_type" value="{{ $quiz->quiz_file ? 'file' : 'questions' }}">
                <div class="form-grid">
                    <div class="field field-wide"><label>Title</label><input type="text" name="title" value="{{ old('title', $quiz->title) }}" required></div>
                    <div class="field field-wide"><label>Description</label><textarea name="description" rows="3" required>{{ old('description', $quiz->description) }}</textarea></div>
                    <div class="field">
                        <label>Class</label>
                        <select id="class_id" name="class_id" required>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id', $quiz->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Subject</label>
                        <select id="subject_id" name="subject_id" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $selectedSubjectId) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field"><label>Start Time</label><input type="datetime-local" name="start_time" value="{{ old('start_time', optional($quiz->start_time)->format('Y-m-d\\TH:i')) }}" required></div>
                    <div class="field"><label>End Time</label><input type="datetime-local" name="end_time" value="{{ old('end_time', optional($quiz->end_time)->format('Y-m-d\\TH:i')) }}" required></div>
                    <div class="field"><label>Duration (minutes)</label><input type="number" name="duration" min="1" value="{{ old('duration', $quiz->duration) }}" required></div>
                    @if($quiz->quiz_file)
                        <div class="field"><label>Replace File</label><input type="file" name="quiz_file" accept=".pdf,.doc,.docx,.csv,.xlsx,.xls,.json"><span class="field-help">Current: {{ $quiz->quiz_file }}</span></div>
                    @endif
                </div>

                @unless($quiz->quiz_file)
                    <div class="panel-title quiz-question-title"><strong>Questions</strong><button type="button" class="ui-btn ui-btn-soft" id="addQuestion"><i class="fas fa-plus"></i> Add</button></div>
                    <div id="questions">
                        @forelse($quiz->questions as $index => $question)
                            <div class="question-box">
                                <div class="field"><label>Question</label><textarea name="questions[{{ $index }}][question_text]" rows="2" required>{{ old("questions.$index.question_text", $question->question_text) }}</textarea></div>
                                <div class="form-grid">
                                    <div class="field"><label>Option 1</label><input name="questions[{{ $index }}][option1]" value="{{ old("questions.$index.option1", $question->option1 ?? $question->option_a) }}" required></div>
                                    <div class="field"><label>Option 2</label><input name="questions[{{ $index }}][option2]" value="{{ old("questions.$index.option2", $question->option2 ?? $question->option_b) }}" required></div>
                                    <div class="field"><label>Option 3</label><input name="questions[{{ $index }}][option3]" value="{{ old("questions.$index.option3", $question->option3 ?? $question->option_c) }}" required></div>
                                    <div class="field"><label>Option 4</label><input name="questions[{{ $index }}][option4]" value="{{ old("questions.$index.option4", $question->option4 ?? $question->option_d) }}" required></div>
                                    <div class="field"><label>Correct</label><select name="questions[{{ $index }}][correct_option]" required>
                                        @foreach(['option1' => 'Option 1', 'option2' => 'Option 2', 'option3' => 'Option 3', 'option4' => 'Option 4'] as $value => $label)
                                            <option value="{{ $value }}" {{ old("questions.$index.correct_option", $question->correct_option) === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select></div>
                                </div>
                            </div>
                        @empty
                            <div class="question-box">
                                <div class="field"><label>Question</label><textarea name="questions[0][question_text]" rows="2" required></textarea></div>
                                <div class="form-grid">
                                    <div class="field"><label>Option 1</label><input name="questions[0][option1]" required></div>
                                    <div class="field"><label>Option 2</label><input name="questions[0][option2]" required></div>
                                    <div class="field"><label>Option 3</label><input name="questions[0][option3]" required></div>
                                    <div class="field"><label>Option 4</label><input name="questions[0][option4]" required></div>
                                    <div class="field"><label>Correct</label><select name="questions[0][correct_option]" required><option value="option1">Option 1</option><option value="option2">Option 2</option><option value="option3">Option 3</option><option value="option4">Option 4</option></select></div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                @endunless

                <div class="form-actions"><button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
<script>
const button = document.getElementById("addQuestion");
if (button) {
    button.addEventListener("click", () => {
        const wrap = document.getElementById("questions");
        const index = wrap.children.length;
        wrap.insertAdjacentHTML("beforeend", `
            <div class="question-box">
                <div class="field"><label>Question</label><textarea name="questions[${index}][question_text]" rows="2" required></textarea></div>
                <div class="form-grid">
                    <div class="field"><label>Option 1</label><input name="questions[${index}][option1]" required></div>
                    <div class="field"><label>Option 2</label><input name="questions[${index}][option2]" required></div>
                    <div class="field"><label>Option 3</label><input name="questions[${index}][option3]" required></div>
                    <div class="field"><label>Option 4</label><input name="questions[${index}][option4]" required></div>
                    <div class="field"><label>Correct</label><select name="questions[${index}][correct_option]" required><option value="option1">Option 1</option><option value="option2">Option 2</option><option value="option3">Option 3</option><option value="option4">Option 4</option></select></div>
                </div>
            </div>`);
    });
}
</script>
@endsection
