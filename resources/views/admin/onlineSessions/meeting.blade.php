@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-video"></i> Session Created</h1>
                <p>Share the code or open the meeting link.</p>
            </div>
            <a href="{{ route('admin.onlineSessions') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Sessions</a>
        </div>

        <div class="detail-card">
            <div class="detail-title"><i class="fas fa-key"></i> Meeting Details</div>
            <div class="info-grid">
                <div class="info-item">
                    <span>Meeting Code</span>
                    <strong id="meetingCode">{{ $meeting->meeting_code }}</strong>
                </div>
                <div class="info-item wide">
                    <span>Meeting URL</span>
                    <strong><a href="{{ $meeting->meeting_url }}" target="_blank">{{ $meeting->meeting_url }}</a></strong>
                </div>
            </div>
            <div class="detail-actions">
                <a href="{{ $meeting->meeting_url }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-external-link-alt"></i> Open Meeting</a>
                <button type="button" class="ui-btn ui-btn-light" id="copyCode"><i class="fas fa-copy"></i> Copy Code</button>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .detail-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; justify-content: space-between; gap: 14px; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.detail-title { border-bottom: 1px solid #e5e7eb; color: #172033; font-weight: 800; padding: 13px 16px; }
.detail-title i { color: #123d35; margin-right: 8px; }
.info-grid { display: grid; gap: 12px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); padding: 16px; }
.info-item { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; padding: 12px; }
.info-item.wide { grid-column: 1 / -1; }
.info-item span { color: #6b7280; display: block; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.info-item strong { color: #172033; display: block; margin-top: 4px; word-break: break-word; }
.detail-actions { border-top: 1px solid #e5e7eb; display: flex; gap: 8px; padding: 16px; }
@media (max-width: 768px) { .page-panel, .detail-actions { align-items: flex-start; flex-direction: column; } }
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
document.getElementById('copyCode').addEventListener('click', function() {
    navigator.clipboard.writeText(document.getElementById('meetingCode').textContent.trim());
    this.innerHTML = '<i class="fas fa-check"></i> Copied';
});
</script>
@endsection
