@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-video"></i> Online Sessions</h1>
                <p>Create a meeting or join an existing session by code.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.createMeeting') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Create Session</a>
                <a href="{{ route('admin.joinOnlineSessions') }}" class="ui-btn ui-btn-light"><i class="fas fa-sign-in-alt"></i> Join Session</a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span>Total Sessions</span>
                <strong>{{ $online_sessions->count() }}</strong>
            </div>
            <div class="stat-card">
                <span>Latest Code</span>
                <strong>{{ optional($online_sessions->last())->meeting_code ?: 'None' }}</strong>
            </div>
        </div>

        <div class="table-card">
            <div class="table-title">
                <strong>Created Sessions</strong>
                <span>{{ $online_sessions->count() }} records</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Created</th>
                            <th class="text-right">Open</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($online_sessions as $session)
                            <tr>
                                <td><strong>{{ $session->meeting_code }}</strong></td>
                                <td>{{ $session->created_at ? $session->created_at->format('M j, Y g:i A') : 'N/A' }}</td>
                                <td class="text-right"><a href="{{ $session->meeting_url }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-external-link-alt"></i> Join</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="empty-cell">No sessions created yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .stat-card, .table-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; gap: 14px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.stats-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); margin-bottom: 14px; }
.stat-card { padding: 16px; }
.stat-card span { color: #6b7280; display: block; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.stat-card strong { color: #172033; display: block; font-size: 24px; margin-top: 4px; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.empty-cell { color: #6b7280; text-align: center; }
@media (max-width: 768px) { .page-panel { align-items: flex-start; flex-direction: column; } .stats-grid { grid-template-columns: 1fr; } }
</style>

<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
