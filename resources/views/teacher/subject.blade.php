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

        <section class="item-grid">
            @forelse($materials as $material)
                <article class="panel-card item-card material-item">
                    <div class="item-icon">
                        <i class="fas fa-{{ $material->type === 'video' ? 'play-circle' : ($material->type === 'link' ? 'link' : 'file-alt') }}"></i>
                    </div>
                    <div>
                        <h3>{{ $material->title }}</h3>
                        <p>{{ ucfirst($material->type) }} • {{ $material->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="item-actions">
                        <a href="{{ route('material.show', $material->id) }}" class="icon-btn" title="View material">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('material.download', $material->id) }}" class="icon-btn" title="Open material">
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
                </article>
            @empty
                <section class="panel-card empty-state">
                    <i class="fas fa-folder-open"></i>
                    <h3>No materials yet</h3>
                    <p>Add the first material for this subject.</p>
                    <a href="{{ route('teacherMaterials.upload', ['class' => $class->id, 'subject' => $subject->id]) }}" class="ui-btn ui-btn-primary">
                        <i class="fas fa-plus"></i> Add Material
                    </a>
                </section>
            @endforelse
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
