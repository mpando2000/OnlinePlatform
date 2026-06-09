@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-folder-open"></i> {{ $subject->name }}</h1>
                <p>{{ $class->name }} teaching materials.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('teacherMaterials.upload', ['class' => $class->id, 'subject' => $subject->id]) }}" class="ui-btn ui-btn-primary">
                    <i class="fas fa-plus"></i> Add Material
                </a>
                <a href="/teacher/viewClass/{{ $class->id }}" class="ui-btn ui-btn-soft">
                    <i class="fas fa-arrow-left"></i> Subjects
                </a>
            </div>
        </div>

        <section class="panel-card table-card">
            <div class="panel-title">
                <strong>Material List</strong>
                <span>{{ $materials->count() }} materials</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Type</th>
                            <th>Uploaded</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td>
                                    <strong>{{ $material->title }}</strong>
                                    <span>{{ optional($material->subject)->name ?? $subject->name }}</span>
                                </td>
                                <td>{{ ucfirst($material->type) }}</td>
                                <td>{{ $material->created_at->format('M d, Y') }}<span>{{ $material->created_at->diffForHumans() }}</span></td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('material.show', $material->id) }}" class="icon-btn" title="View material">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('material.view', $material->id) }}" target="_blank" class="icon-btn" title="View material document">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <form action="{{ route('material.delete', $material->id) }}" method="POST" onsubmit="return confirm('Delete this material?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn danger" title="Delete material">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-cell">
                                    No materials yet. Add the first material for this subject.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
