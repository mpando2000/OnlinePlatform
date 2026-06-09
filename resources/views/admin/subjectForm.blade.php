@extends('components.dashmaster')

@section('body')
<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-plus"></i> Add Subject</h1>
                <p>{{ $school_class->name }}</p>
            </div>
            <a href="{{ route('admin.class', $school_class->id) }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Subjects</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('storeSubject', $school_class->id) }}" method="POST">
                @csrf
                <input type="hidden" name="school_class_id" value="{{ $school_class->id }}">
                <div class="field">
                    <label>Subject Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Mathematics" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Subject</button>
                    <a href="{{ route('admin.class', $school_class->id) }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.form-page { background: #f5f7fb; min-height: 100vh; }
.form-shell { max-width: 860px; padding: 18px; }
.form-header-panel, .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.form-header-panel { align-items: center; display: flex; justify-content: space-between; gap: 14px; margin-bottom: 14px; padding: 16px 18px; }
.form-header-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.form-header-panel h1 i { color: #123d35; margin-right: 8px; }
.form-header-panel p { color: #6b7280; margin: 4px 0 0; }
.form-card { padding: 18px; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.field input:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.form-actions { display: flex; gap: 8px; margin-top: 18px; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
@media (max-width: 768px) { .form-header-panel { align-items: flex-start; flex-direction: column; } .form-actions { flex-direction: column; } }
</style>

<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
