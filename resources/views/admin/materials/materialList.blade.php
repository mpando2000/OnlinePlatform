@php use Illuminate\Support\Facades\Storage; @endphp
@extends('components.dashmaster')

@section('body')
<div class="content-wrapper materials-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-folder-open"></i> {{ $subject->name }} Materials</h1>
                <p>{{ $class->name }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('adminMaterials.upload', ['class' => $class->id, 'subject' => $subject->id]) }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Add Material</a>
                <a href="{{ route('admin.class', $class->id) }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Subjects</a>
            </div>
        </div>

        <div class="table-card">
            <div class="table-title">
                <strong>Learning Materials</strong>
                <span>{{ $materials->count() }} materials</span>
            </div>
            <div class="materials-grid">
                @forelse($materials as $material)
                    <article class="material-card">
                        <div class="material-icon"><i class="fas {{ $material->type === 'video' ? 'fa-play' : ($material->type === 'link' ? 'fa-link' : 'fa-file-alt') }}"></i></div>
                        <div>
                            <strong>{{ $material->title }}</strong>
                            <span>{{ ucfirst($material->type) }} · {{ $material->created_at ? $material->created_at->format('M j, Y') : 'N/A' }}</span>
                        </div>
                        <div class="material-actions">
                            @if($material->type === 'link')
                                <a href="{{ $material->url }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-external-link-alt"></i> Open</a>
                            @elseif($material->file_path && Storage::disk('public')->exists($material->file_path))
                                <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-download"></i> Open</a>
                            @else
                                <span class="muted">File missing</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="empty-state">No materials found for this subject.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.materials-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .table-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; justify-content: space-between; gap: 14px; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p, .muted { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.materials-grid { display: grid; gap: 10px; padding: 16px; }
.material-card { align-items: center; background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; display: grid; gap: 12px; grid-template-columns: auto 1fr auto; padding: 12px; }
.material-icon { align-items: center; background: #ecfdf5; border-radius: 8px; color: #047857; display: flex; height: 42px; justify-content: center; width: 42px; }
.material-card strong { color: #172033; display: block; }
.material-card span { color: #6b7280; font-size: 12px; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
@media (max-width: 768px) { .page-panel, .material-card { align-items: flex-start; grid-template-columns: 1fr; flex-direction: column; } }
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
