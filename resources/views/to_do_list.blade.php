@extends('components.dashmaster')

@section('body')
<div class="content-wrapper todo-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-check-square"></i> To-Do List</h1>
                <p>Track your daily tasks.</p>
            </div>
            <span class="count-pill">{{ $tasks->where('completed', false)->count() }} pending</span>
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

        <div class="todo-layout">
            <aside class="form-card">
                <div class="card-title"><strong>Add Task</strong></div>
                <form method="POST" action="{{ route('to-do-list.store') }}">
                    @csrf
                    <div class="field">
                        <label>Task</label>
                        <input type="text" name="task" value="{{ old('task') }}" required>
                    </div>
                    <div class="field">
                        <label>Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}">
                    </div>
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Add Task</button>
                </form>
            </aside>

            <section class="table-card">
                <div class="table-title">
                    <strong>My Tasks</strong>
                    <span>{{ $tasks->count() }} total</span>
                </div>
                <div class="task-list">
                    @forelse($tasks as $task)
                        @php($isOverdue = $task->due_date && $task->due_date->isPast() && !$task->completed)
                        <article class="task-item {{ $task->completed ? 'done' : '' }}">
                            <form method="POST" action="{{ route('to-do-list.update', $task->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="check-btn" title="Toggle complete">
                                    <i class="fas {{ $task->completed ? 'fa-check-circle' : 'fa-circle' }}"></i>
                                </button>
                            </form>
                            <div class="task-body">
                                <strong>{{ $task->task }}</strong>
                                <span class="{{ $isOverdue ? 'overdue' : '' }}">
                                    {{ $task->due_date ? 'Due ' . $task->due_date->format('M j, Y') : 'No due date' }}
                                </span>
                            </div>
                            <form method="POST" action="{{ route('to-do-list.destroy', $task->id) }}" onsubmit="return confirm('Delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </article>
                    @empty
                        <div class="empty-state">No tasks yet.</div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.todo-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .form-card, .table-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; justify-content: space-between; gap: 14px; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.count-pill { background: #ecfdf5; border-radius: 999px; color: #047857; font-size: 12px; font-weight: 800; padding: 6px 10px; }
.todo-layout { display: grid; gap: 14px; grid-template-columns: 360px minmax(0, 1fr); }
.card-title, .table-title { border-bottom: 1px solid #e5e7eb; padding: 13px 16px; }
.table-title { align-items: center; display: flex; justify-content: space-between; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.form-card form { padding: 16px; }
.field { margin-bottom: 12px; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.field input:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.ui-btn, .icon-btn, .check-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 34px; padding: 8px 12px; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; text-decoration: none; }
.task-list { display: grid; gap: 8px; padding: 16px; }
.task-item { align-items: center; background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; display: grid; gap: 10px; grid-template-columns: auto 1fr auto; padding: 12px; }
.task-item.done { opacity: .68; }
.task-item.done strong { text-decoration: line-through; }
.task-body strong { color: #172033; display: block; }
.task-body span { color: #6b7280; font-size: 12px; }
.task-body .overdue { color: #b91c1c; font-weight: 800; }
.check-btn, .icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.check-btn { color: #047857; }
.icon-btn.danger { color: #b91c1c; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
@media (max-width: 900px) { .todo-layout { grid-template-columns: 1fr; } .page-panel { align-items: flex-start; flex-direction: column; } }
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
