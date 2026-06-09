@extends('components.dashmaster')

@section('body')
<div class="content-wrapper assign-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chalkboard-teacher"></i> Assign Classes</h1>
                <p>{{ $teacher->firstname }} {{ $teacher->secondname }} {{ $teacher->lastname }}</p>
            </div>
            <a href="{{ route('admin.users') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Users</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="assign-layout">
            <section class="teacher-card">
                <img src="{{ $teacher->profile_image ? asset('uploads/profile_images/' . $teacher->profile_image) : asset('dist/img/avatar5.png') }}" alt="Teacher">
                <h2>{{ $teacher->firstname }} {{ $teacher->lastname }}</h2>
                <span>{{ $teacher->email }}</span>
                <strong>{{ $teacher->teacherSubjects->count() }} assignments</strong>
            </section>

            <section class="table-card">
                <div class="table-title">
                    <strong>Current Assignments</strong>
                    <span>{{ $teacher->teacherSubjects->count() }} subjects</span>
                </div>
                <div class="assignment-list">
                    @php($groupedAssignments = $teacher->teacherSubjects->groupBy('pivot.class_id'))
                    @forelse($groupedAssignments as $classId => $subjects)
                        @php($assignedClass = $classes->firstWhere('id', (int) $classId))
                        @if($assignedClass)
                            <article class="assignment-row">
                                <div>
                                    <strong>{{ $assignedClass->name }}</strong>
                                    <span>{{ $subjects->pluck('name')->join(', ') }}</span>
                                </div>
                                <form action="{{ route('adminUsers.remove-class-assignment', $teacher->id) }}" method="POST" onsubmit="return confirm('Remove this class assignment?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="class_id" value="{{ $assignedClass->id }}">
                                    <button type="submit" class="icon-btn danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </article>
                        @endif
                    @empty
                        <div class="empty-state">No class or subject assignments yet.</div>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="form-card">
            <div class="table-title">
                <strong>Add Assignment</strong>
                <button type="button" class="ui-btn ui-btn-light" id="addPair"><i class="fas fa-plus"></i> Add Row</button>
            </div>
            <form method="POST" action="{{ route('adminUsers.store-class-subject-assign', $teacher->id) }}" id="assignmentForm">
                @csrf
                <div id="pairs" class="pair-list">
                    <div class="pair-row">
                        <div class="field">
                            <label>Class</label>
                            <select name="classes[]" class="class-select" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label>Subject</label>
                            <select name="subjects[]" class="subject-select" required>
                                <option value="">Select class first</option>
                            </select>
                        </div>
                        <button type="button" class="icon-btn danger remove-pair" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Assignments</button>
                </div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.assign-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .teacher-card, .table-card, .form-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}
.page-panel {
    align-items: center;
    display: flex;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 14px;
    padding: 16px 18px;
}
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.ui-btn, .icon-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 34px;
    padding: 8px 12px;
}
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.assign-layout { display: grid; gap: 14px; grid-template-columns: 300px minmax(0, 1fr); margin-bottom: 14px; }
.teacher-card { padding: 18px; text-align: center; }
.teacher-card img { border-radius: 50%; height: 92px; object-fit: cover; width: 92px; }
.teacher-card h2 { color: #172033; font-size: 19px; font-weight: 800; margin: 12px 0 4px; }
.teacher-card span { color: #6b7280; display: block; }
.teacher-card strong { background: #ecfdf5; border-radius: 999px; color: #047857; display: inline-block; font-size: 12px; margin-top: 12px; padding: 6px 10px; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.assignment-list, .pair-list { display: grid; gap: 10px; padding: 16px; }
.assignment-row, .pair-row {
    align-items: center;
    background: #f8fafc;
    border: 1px solid #eef2f7;
    border-radius: 8px;
    display: grid;
    gap: 12px;
    grid-template-columns: 1fr auto;
    padding: 12px;
}
.assignment-row strong { color: #172033; display: block; }
.assignment-row span { color: #6b7280; display: block; font-size: 12px; margin-top: 3px; }
.assignment-row form { margin: 0; }
.pair-row { grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) auto; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field select {
    border: 1px solid #d7dde6;
    border-radius: 6px;
    min-height: 40px;
    padding: 9px 11px;
    width: 100%;
}
.field select:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.icon-btn.danger { color: #b91c1c; }
.form-actions { padding: 0 16px 16px; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
@media (max-width: 900px) {
    .assign-layout, .pair-row { grid-template-columns: 1fr; }
    .page-panel { align-items: flex-start; flex-direction: column; }
}
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();

const pairs = document.getElementById('pairs');
const firstPair = pairs.querySelector('.pair-row');

async function loadSubjects(row) {
    const classId = row.querySelector('.class-select').value;
    const subjectSelect = row.querySelector('.subject-select');
    subjectSelect.innerHTML = '<option value="">Loading subjects...</option>';

    if (!classId) {
        subjectSelect.innerHTML = '<option value="">Select class first</option>';
        return;
    }

    try {
        const response = await fetch(`/admin/get-subjects/${classId}`, {
            headers: { 'Accept': 'application/json' }
        });
        const subjects = await response.json();
        subjectSelect.innerHTML = '<option value="">Select Subject</option>';
        subjects.forEach(function(subject) {
            const option = document.createElement('option');
            option.value = subject.id;
            option.textContent = subject.name;
            subjectSelect.appendChild(option);
        });
    } catch (error) {
        subjectSelect.innerHTML = '<option value="">Unable to load subjects</option>';
    }
}

pairs.addEventListener('change', function(event) {
    if (event.target.classList.contains('class-select')) {
        loadSubjects(event.target.closest('.pair-row'));
    }
});

pairs.addEventListener('click', function(event) {
    const button = event.target.closest('.remove-pair');
    if (!button) return;
    if (pairs.querySelectorAll('.pair-row').length === 1) {
        button.closest('.pair-row').querySelector('.class-select').value = '';
        button.closest('.pair-row').querySelector('.subject-select').innerHTML = '<option value="">Select class first</option>';
        return;
    }
    button.closest('.pair-row').remove();
});

document.getElementById('addPair').addEventListener('click', function() {
    const row = firstPair.cloneNode(true);
    row.querySelector('.class-select').value = '';
    row.querySelector('.subject-select').innerHTML = '<option value="">Select class first</option>';
    pairs.appendChild(row);
});
</script>
@endsection
