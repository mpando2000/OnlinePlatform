@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-school"></i> Schools</h1>
                <p>Manage schools registered in the platform.</p>
            </div>
            <a href="{{ route('admin.schools.create') }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Add School</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-card">
            <div class="table-title">
                <strong>School List</strong>
                <span>{{ $schools->total() }} schools</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>School</th>
                            <th>Code</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schools as $school)
                            <tr>
                                <td>
                                    <strong>{{ $school->name }}</strong>
                                    <span>{{ $school->address ?: 'No address' }}</span>
                                </td>
                                <td>{{ $school->code }}</td>
                                <td>
                                    <strong>{{ $school->phone ?: 'No phone' }}</strong>
                                    <span>{{ $school->email ?: 'No email' }}</span>
                                </td>
                                <td><span class="status-pill status-{{ $school->status }}">{{ ucfirst($school->status) }}</span></td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ route('admin.schools.show', $school) }}" class="icon-btn" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.schools.edit', $school) }}" class="icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.schools.destroy', $school) }}" method="POST" onsubmit="return confirm('Delete this school?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn danger" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-cell">No schools found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">{{ $schools->links() }}</div>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .table-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; gap: 14px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.ui-btn, .icon-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 34px; padding: 8px 12px; }
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.clean-table td span { color: #6b7280; display: block; font-size: 12px; margin-top: 2px; }
.row-actions { display: flex; gap: 6px; justify-content: flex-end; }
.row-actions form { margin: 0; }
.icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.icon-btn.danger { color: #b91c1c; }
.status-pill { border-radius: 999px; display: inline-block!important; font-size: 12px; font-weight: 800; padding: 5px 9px; }
.status-active { background: #ecfdf5; color: #047857!important; }
.status-inactive { background: #f3f4f6; color: #4b5563!important; }
.empty-cell { color: #6b7280; text-align: center; }
.pagination-wrap { padding: 12px 16px; }
@media (max-width: 768px) { .page-panel { align-items: flex-start; flex-direction: column; } }
</style>

<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
