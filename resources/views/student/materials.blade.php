@extends('components.dashmaster')

@section('body')
<div class="content-wrapper student-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-folder-open"></i> {{ $subject->name }}</h1>
                <p>Learning materials and resources.</p>
            </div>
            <a href="{{ route('student.class') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Subjects</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card"><i class="fas fa-file-alt"></i><div><strong>{{ $materials->where('type', 'document')->count() }}</strong><span>Documents</span></div></div>
            <div class="stat-card"><i class="fas fa-video"></i><div><strong>{{ $materials->where('type', 'video')->count() }}</strong><span>Videos</span></div></div>
            <div class="stat-card"><i class="fas fa-link"></i><div><strong>{{ $materials->where('type', 'link')->count() }}</strong><span>Links</span></div></div>
            <div class="stat-card"><i class="fas fa-folder"></i><div><strong>{{ $materials->count() }}</strong><span>Total</span></div></div>
        </div>

        <section class="panel-card">
            <div class="panel-title">
                <strong>Materials</strong>
                <span>{{ $materials->count() }} items</span>
            </div>
            <div class="item-list">
                @forelse($materials as $material)
                    <article class="list-card">
                        <i class="fas {{ $material->type === 'video' ? 'fa-video' : ($material->type === 'link' ? 'fa-link' : 'fa-file-alt') }}"></i>
                        <div>
                            <strong>{{ $material->title }}</strong>
                            <span>{{ ucfirst($material->type) }} · {{ $material->created_at ? $material->created_at->format('M j, Y') : 'N/A' }}</span>
                        </div>
                        <div class="row-actions">
                            @if($material->type === 'link')
                                <a href="{{ $material->url }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-external-link-alt"></i> Open</a>
                            @else
                                <a href="{{ route('student.material.open', $material->id) }}" target="_blank" class="ui-btn ui-btn-light"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('student.materials.download', $material->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-download"></i> Download</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="empty-state">No materials available for this subject.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('student.partials.clean-styles')
@endsection
