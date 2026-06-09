@extends('components.dashmaster')

@section('body')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fas fa-file-alt text-primary"></i> Learning Materials</h1>
                    <p class="text-muted">Access study materials and resources for {{ $subject->name }}</p>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        <a href="{{ route('student.class') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Subjects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Subject Info Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-gradient-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-book mr-2"></i>{{ $subject->name }}
                                </h3>
                                <div>
                                    <span class="badge badge-light badge-lg">
                                        <i class="fas fa-file-alt"></i> {{ $materials->count() }} Material{{ $materials->count() != 1 ? 's' : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-primary">
                                            <i class="fas fa-file-pdf"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Documents</span>
                                            <span class="info-box-number">{{ $materials->where('type', 'document')->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-info">
                                            <i class="fas fa-link"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Links</span>
                                            <span class="info-box-number">{{ $materials->where('type', 'link')->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-success">
                                            <i class="fas fa-video"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Videos</span>
                                            <span class="info-box-number">{{ $materials->where('type', 'video')->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-warning">
                                            <i class="fas fa-folder-open"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Items</span>
                                            <span class="info-box-number">{{ $materials->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($materials->isNotEmpty())
                <!-- Materials Grid -->
                <div class="row">
                    @foreach($materials as $index => $material)
                        @php
                            $typeIcons = [
                                'document' => 'file-pdf',
                                'link' => 'external-link-alt',
                                'video' => 'video'
                            ];
                            $typeColors = [
                                'document' => 'danger',
                                'link' => 'info', 
                                'video' => 'success'
                            ];
                            $typeLabels = [
                                'document' => 'Document',
                                'link' => 'Web Link',
                                'video' => 'Video'
                            ];
                            $icon = $typeIcons[$material->type] ?? 'file';
                            $color = $typeColors[$material->type] ?? 'secondary';
                            $label = $typeLabels[$material->type] ?? ucfirst($material->type);
                        @endphp
                        
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card h-100 border-0 shadow-sm hover-card material-card">
                                <div class="card-header bg-gradient-{{ $color }} text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-{{ $icon }}"></i>
                                            {{ Str::limit($material->title, 40) }}
                                        </h5>
                                        <span class="badge badge-light">
                                            {{ $label }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="material-info mb-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt text-primary"></i>
                                                    Added: {{ $material->created_at->format('M d, Y') }}
                                                </small>
                                            </div>
                                            <div class="col-sm-6">
                                                <small class="text-muted">
                                                    <i class="fas fa-tag text-success"></i>
                                                    Type: {{ $label }}
                                                </small>
                                            </div>
                                        </div>
                                        
                                        @if($material->type === 'link' && $material->url)
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <small class="text-muted">
                                                        <i class="fas fa-link text-info"></i>
                                                        <a href="{{ $material->url }}" target="_blank" class="text-info">
                                                            {{ Str::limit($material->url, 50) }}
                                                        </a>
                                                    </small>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-auto">
                                        <div class="row">
                                            @if($material->type === 'link')
                                                <div class="col-md-6 mb-2">
                                                    <a href="{{ $material->url }}" 
                                                       target="_blank"
                                                       class="btn btn-info btn-sm btn-block">
                                                        <i class="fas fa-external-link-alt"></i> Open Link
                                                    </a>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <button class="btn btn-outline-secondary btn-sm btn-block copy-link" 
                                                            data-url="{{ $material->url }}">
                                                        <i class="fas fa-copy"></i> Copy URL
                                                    </button>
                                                </div>
                                            @else
                                                <div class="col-md-6 mb-2">
                                                    <a href="{{ route('student.materials.download', $material->id) }}" 
                                                       class="btn btn-{{ $color }} btn-sm btn-block">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <a href="{{ route('student.material.open', $material->id) }}" 
                                                       target="_blank"
                                                       class="btn btn-outline-{{ $color }} btn-sm btn-block">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> 
                                            Last updated: {{ $material->updated_at->diffForHumans() }}
                                        </small>
                                        @if($material->file_path)
                                            <small class="text-muted">
                                                <i class="fas fa-file"></i> 
                                                File available
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Quick Actions Card -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-tools text-primary"></i> Quick Actions
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-primary btn-block download-all">
                                            <i class="fas fa-download"></i> Download All Documents
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-info btn-block" onclick="window.print()">
                                            <i class="fas fa-print"></i> Print Material List
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-success btn-block refresh-materials">
                                            <i class="fas fa-sync-alt"></i> Refresh Materials
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="{{ route('student.class') }}" class="btn btn-outline-secondary btn-block">
                                            <i class="fas fa-arrow-left"></i> Back to Subjects
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No Materials Available</h4>
                                <p class="text-muted">
                                    No learning materials have been uploaded for <strong>{{ $subject->name }}</strong> yet.
                                    Check back later or contact your teacher for more information.
                                </p>
                                <div class="mt-4">
                                    <button class="btn btn-primary refresh-materials">
                                        <i class="fas fa-refresh"></i> Refresh Page
                                    </button>
                                    <a href="{{ route('student.class') }}" class="btn btn-secondary ml-2">
                                        <i class="fas fa-arrow-left"></i> Back to Subjects
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Custom Styles -->
<style>
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    .material-card {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }
    
    .material-card:hover {
        border-left-color: #007bff;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        font-weight: 600;
    }
    
    .card-header h5 {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .badge-lg {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .info-box {
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .info-box-icon {
        border-radius: 10px 0 0 10px;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .material-info {
        background: rgba(0,123,255,0.05);
        border-radius: 8px;
        padding: 0.75rem;
        border-left: 3px solid #007bff;
    }
    
    .material-info i {
        margin-right: 0.25rem;
    }
    
    /* Material type specific styling */
    .material-card .bg-gradient-danger .fa-file-pdf {
        animation: document-pulse 2s ease-in-out infinite;
    }
    
    .material-card .bg-gradient-info .fa-external-link-alt {
        animation: link-bounce 2s ease-in-out infinite;
    }
    
    .material-card .bg-gradient-success .fa-video {
        animation: video-play 2s ease-in-out infinite;
    }
    
    @keyframes document-pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    @keyframes link-bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-3px); }
        60% { transform: translateY(-1px); }
    }
    
    @keyframes video-play {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Loading animation for buttons */
    .btn.loading {
        pointer-events: none;
        position: relative;
        opacity: 0.8;
    }
    
    .btn.loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: button-loading-spinner 1s ease infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    @keyframes button-loading-spinner {
        from { transform: translate(-50%, -50%) rotate(0turn); }
        to { transform: translate(-50%, -50%) rotate(1turn); }
    }
    
    /* Fade in animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Staggered animation for cards */
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }
    
    /* Search and filter animations */
    .material-card.filtered-out {
        opacity: 0.3;
        transform: scale(0.95);
        pointer-events: none;
    }
    
    /* Copy success animation */
    .copy-success {
        animation: copy-flash 0.5s ease-in-out;
    }
    
    @keyframes copy-flash {
        0%, 100% { background-color: transparent; }
        50% { background-color: rgba(40, 167, 69, 0.2); }
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .content-header .col-sm-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
        
        .info-box {
            margin-bottom: 1rem;
        }
        
        .card-body .row .col-md-6 {
            margin-bottom: 0.5rem;
        }
        
        .hover-card:hover {
            transform: none;
        }
    }
    
    /* Toast notification styles */
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease-out;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    /* Print styles */
    @media print {
        .btn, .card-footer, .quick-actions {
            display: none !important;
        }
        
        .card {
            break-inside: avoid;
            margin-bottom: 1rem;
        }
    }
</style>

<!-- Scripts -->
<script>
    // Footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced materials page functionality
    document.addEventListener('DOMContentLoaded', function() {
        
        // Copy link functionality
        const copyButtons = document.querySelectorAll('.copy-link');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                
                navigator.clipboard.writeText(url).then(() => {
                    // Show success feedback
                    this.classList.add('copy-success');
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Copied!';
                    
                    setTimeout(() => {
                        this.classList.remove('copy-success');
                        this.innerHTML = originalText;
                    }, 2000);
                    
                    showToast('Link copied to clipboard!', 'success');
                }).catch(err => {
                    showToast('Failed to copy link. Please try again.', 'error');
                });
            });
        });
        
        // Download all documents functionality
        const downloadAllBtn = document.querySelector('.download-all');
        if (downloadAllBtn) {
            downloadAllBtn.addEventListener('click', function() {
                const documentLinks = document.querySelectorAll('a[href*="download"]');
                
                if (documentLinks.length === 0) {
                    showToast('No documents available for download.', 'warning');
                    return;
                }
                
                this.classList.add('loading');
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
                
                // Download each document with delay to prevent browser blocking
                let index = 0;
                const downloadNext = () => {
                    if (index < documentLinks.length) {
                        const link = documentLinks[index];
                        // Create temporary link to trigger download
                        const tempLink = document.createElement('a');
                        tempLink.href = link.href;
                        tempLink.style.display = 'none';
                        document.body.appendChild(tempLink);
                        tempLink.click();
                        document.body.removeChild(tempLink);
                        
                        index++;
                        setTimeout(downloadNext, 500); // 500ms delay between downloads
                    } else {
                        // Reset button
                        this.classList.remove('loading');
                        this.innerHTML = '<i class="fas fa-download"></i> Download All Documents';
                        showToast(`Successfully initiated download for ${documentLinks.length} document(s).`, 'success');
                    }
                };
                
                downloadNext();
            });
        }
        
        // Refresh materials functionality
        const refreshButtons = document.querySelectorAll('.refresh-materials');
        refreshButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('loading');
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
                
                setTimeout(() => {
                    location.reload();
                }, 1000);
            });
        });
        
        // Add loading animation to download buttons
        const downloadButtons = document.querySelectorAll('a[href*="download"]');
        downloadButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('loading');
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
                
                // Reset button after 3 seconds
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.innerHTML = originalText;
                }, 3000);
            });
        });
        
        // Add click-to-view functionality for material cards
        const materialCards = document.querySelectorAll('.material-card');
        materialCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't trigger if user clicked on a button or link
                if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' || 
                    e.target.closest('a') || e.target.closest('button')) {
                    return;
                }
                
                // Find the view/open button and click it
                const viewButton = card.querySelector('a[href*="open"], a[href*="http"]');
                if (viewButton) {
                    viewButton.click();
                }
            });
        });
        
        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + D = Download all
            if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
                e.preventDefault();
                const downloadAllBtn = document.querySelector('.download-all');
                if (downloadAllBtn) {
                    downloadAllBtn.click();
                }
            }
            
            // Ctrl/Cmd + R = Refresh (override browser default)
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                const refreshBtn = document.querySelector('.refresh-materials');
                if (refreshBtn) {
                    refreshBtn.click();
                }
            }
            
            // F5 = Refresh
            if (e.key === 'F5') {
                e.preventDefault();
                const refreshBtn = document.querySelector('.refresh-materials');
                if (refreshBtn) {
                    refreshBtn.click();
                }
            }
        });
        
        // Add material type filtering (if needed in future)
        function filterMaterials(type) {
            const cards = document.querySelectorAll('.material-card');
            cards.forEach(card => {
                const cardType = card.querySelector('.badge').textContent.trim();
                if (type === 'all' || cardType === type) {
                    card.classList.remove('filtered-out');
                } else {
                    card.classList.add('filtered-out');
                }
            });
        }
        
        // Add tooltips for better UX
        const tooltips = {
            'Download': 'Download this material to your device',
            'View': 'View this material in browser',
            'Open Link': 'Open this link in a new tab',
            'Copy URL': 'Copy link URL to clipboard'
        };
        
        document.querySelectorAll('.btn').forEach(button => {
            const text = button.textContent.trim();
            Object.keys(tooltips).forEach(key => {
                if (text.includes(key)) {
                    button.title = tooltips[key];
                }
            });
        });
        
        // Track material access for analytics
        document.querySelectorAll('a[href*="open"], a[href*="download"]').forEach(link => {
            link.addEventListener('click', function() {
                const materialTitle = this.closest('.material-card').querySelector('.card-title').textContent.trim();
                const action = this.href.includes('download') ? 'download' : 'view';
                
                // Store in localStorage for later analytics
                const accessed = JSON.parse(localStorage.getItem('accessedMaterials') || '{}');
                const key = `{{ $subject->name }}_${materialTitle}`;
                accessed[key] = {
                    title: materialTitle,
                    subject: '{{ $subject->name }}',
                    action: action,
                    timestamp: new Date().toISOString()
                };
                localStorage.setItem('accessedMaterials', JSON.stringify(accessed));
            });
        });
    });
    
    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} toast-notification`;
        
        const iconMap = {
            'success': 'check-circle',
            'error': 'exclamation-triangle', 
            'warning': 'exclamation-circle',
            'info': 'info-circle'
        };
        
        toast.innerHTML = `
            <i class="fas fa-${iconMap[type] || 'info-circle'} mr-2"></i>
            ${message}
            <button type="button" class="close" onclick="this.parentElement.remove()">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }
        }, 5000);
    }
</script>

@endsection
