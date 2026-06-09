@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-user-check"></i> Promote Selected Students</h1>
                <p>Choose a new class for each student.</p>
            </div>
            <a href="{{ route('admin.promotions.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Promotions</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.promotions.promote') }}" method="POST" class="table-card">
            @csrf
            <div class="table-title"><strong>Students by Class</strong><span>{{ $currentYear }}</span></div>
            <div class="promotion-list">
                @php($index = 0)
                @foreach($classes as $class)
                    @foreach($class->students as $student)
                        <div class="promotion-row">
                            <div>
                                <strong>{{ $student->firstname }} {{ $student->lastname }}</strong>
                                <span>{{ $class->name }}</span>
                            </div>
                            <input type="hidden" name="promotions[{{ $index }}][student_id]" value="{{ $student->id }}">
                            <select name="promotions[{{ $index }}][to_class_id]" required>
                                <option value="">Promote To</option>
                                @foreach($classes as $toClass)
                                    <option value="{{ $toClass->id }}">{{ $toClass->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @php($index++)
                    @endforeach
                @endforeach
                @if($index === 0)
                    <div class="empty-state">No students found in classes.</div>
                @endif
            </div>
            <div class="form-actions">
                <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Promote Selected</button>
            </div>
        </form>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.student-promotions.partials.clean-styles')
@endsection
