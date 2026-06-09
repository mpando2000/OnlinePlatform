@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-file-alt"></i> {{ $material->title }}</h1>
                <p>{{ ucfirst($material->type) }} material.</p>
            </div>
            <a href="javascript:history.back()" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <section class="panel-card form-card">
            <div class="detail-list">
                <div class="detail-row">
                    <span>Subject</span>
                    <strong>{{ optional($material->subject)->name ?? 'Not assigned' }}</strong>
                </div>
                <div class="detail-row">
                    <span>Type</span>
                    <strong>{{ ucfirst($material->type) }}</strong>
                </div>
                <div class="detail-row">
                    <span>Created</span>
                    <strong>{{ $material->created_at->format('M d, Y h:i A') }}</strong>
                </div>
            </div>

            <div class="form-actions">
                @if($material->type === 'link')
                    <a href="{{ $material->url }}" target="_blank" class="ui-btn ui-btn-primary">
                        <i class="fas fa-external-link-alt"></i> Open Link
                    </a>
                @else
                    <a href="{{ route('material.view', $material->id) }}" target="_blank" class="ui-btn ui-btn-primary">
                        <i class="fas fa-eye"></i> View Document
                    </a>
                    <a href="{{ route('material.download', $material->id) }}" class="ui-btn ui-btn-soft">
                        <i class="fas fa-download"></i> Download
                    </a>
                @endif
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
