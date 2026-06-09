@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-user-graduate"></i> Student Promotions</h1>
                <p>{{ $currentYear }} to {{ $nextYear }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.promotions.form') }}" class="ui-btn ui-btn-primary"><i class="fas fa-user-check"></i> Select Students</a>
                <a href="{{ route('admin.promotions.history') }}" class="ui-btn ui-btn-light"><i class="fas fa-history"></i> History</a>
            </div>
        </div>

        @foreach(['success','error','warning'] as $type)
            @if(session($type))
                <div class="alert alert-{{ $type === 'error' ? 'danger' : ($type === 'warning' ? 'warning' : 'success') }}">{{ session($type) }}</div>
            @endif
        @endforeach

        <div class="promotion-grid">
            <section class="form-card">
                <div class="card-title"><strong>Bulk Promote Class</strong></div>
                <form action="{{ route('admin.promotions.bulk') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label>From Class</label>
                        <select name="from_class_id" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>To Class</label>
                        <select name="to_class_id" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="ui-btn ui-btn-primary" type="submit"><i class="fas fa-arrow-up"></i> Promote Class</button>
                </form>
            </section>

            <section class="table-card">
                <div class="table-title">
                    <strong>Students Ready</strong>
                    <span>{{ $studentsToPromote->count() }} students</span>
                </div>
                <div class="table-responsive">
                    <table class="clean-table">
                        <thead><tr><th>Student</th><th>Class</th><th>Year</th><th class="text-right">History</th></tr></thead>
                        <tbody>
                            @forelse($studentsToPromote as $student)
                                <tr>
                                    <td><strong>{{ $student->firstname }} {{ $student->lastname }}</strong><span>{{ $student->email }}</span></td>
                                    <td>{{ optional($student->schoolClass)->name ?? 'No class' }}</td>
                                    <td>{{ $student->academic_year ?? $currentYear }}</td>
                                    <td class="text-right"><a href="{{ route('admin.promotions.student-history', $student) }}" class="icon-btn"><i class="fas fa-history"></i></a></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="empty-cell">No students ready for promotion.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('admin.student-promotions.partials.clean-styles')
@endsection
