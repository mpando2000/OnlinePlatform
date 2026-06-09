@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chalkboard"></i> Classes</h1>
                <p>Manage academic classes and their subjects.</p>
            </div>
            <a href="/addClass" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Add Class</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-card">
            <div class="table-title">
                <strong>Class List</strong>
                <span>{{ count($schoolClasses) }} classes</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Created</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schoolClasses as $schoolClass)
                            <tr>
                                <td><strong>{{ $schoolClass->name }}</strong></td>
                                <td>{{ $schoolClass->created_at ? $schoolClass->created_at->format('M j, Y') : 'N/A' }}</td>
                                <td>
                                    <div class="row-actions">
                                        <a href="/viewClass/{{ $schoolClass->id }}" class="icon-btn" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="/editClassForm/{{ $schoolClass->id }}" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="/deleteClass/{{ $schoolClass->id }}" onsubmit="return confirm('Delete this class?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn danger" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty-cell">No classes found. Add your first class to begin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong>
    All rights reserved.
</footer>

<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .table-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}
.page-panel {
    align-items: center;
    display: flex;
    gap: 14px;
    justify-content: space-between;
    margin-bottom: 14px;
    padding: 16px 18px;
}
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.ui-btn, .icon-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 34px;
    padding: 8px 12px;
}
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title strong { color: #172033; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.row-actions { display: flex; gap: 6px; justify-content: flex-end; }
.row-actions form { margin: 0; }
.icon-btn { background: #eef2f7; color: #374151; min-width: 34px; padding: 8px; justify-content: center; }
.icon-btn.danger { color: #b91c1c; }
.empty-cell { color: #6b7280; text-align: center; }
@media (max-width: 768px) { .page-panel { align-items: flex-start; flex-direction: column; } }
</style>

<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
