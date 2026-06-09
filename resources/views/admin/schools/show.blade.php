@extends('components.dashmaster')

@section('body')
<div class="content-wrapper admin-clean-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-school"></i> {{ $school->name }}</h1>
                <p>Code: {{ $school->code }}</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.schools.edit', $school) }}" class="ui-btn ui-btn-primary"><i class="fas fa-edit"></i> Edit</a>
                <a href="{{ route('admin.schools.index') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Schools</a>
            </div>
        </div>

        <div class="detail-grid">
            <section class="detail-card">
                <div class="detail-title"><i class="fas fa-info-circle"></i> School Information</div>
                <div class="info-grid">
                    <div class="info-item"><span>Status</span><strong>{{ ucfirst($school->status) }}</strong></div>
                    <div class="info-item"><span>Users</span><strong>{{ $users_count }}</strong></div>
                    <div class="info-item"><span>Phone</span><strong>{{ $school->phone ?: 'Not provided' }}</strong></div>
                    <div class="info-item"><span>Email</span><strong>{{ $school->email ?: 'Not provided' }}</strong></div>
                    <div class="info-item wide"><span>Address</span><strong>{{ $school->address ?: 'Not provided' }}</strong></div>
                    <div class="info-item wide"><span>Description</span><strong>{{ $school->description ?: 'No description' }}</strong></div>
                </div>
            </section>

            <section class="danger-panel">
                <div>
                    <strong>Delete School</strong>
                    <p>Schools with users cannot be deleted.</p>
                </div>
                <form action="{{ route('admin.schools.destroy', $school) }}" method="POST" onsubmit="return confirm('Delete this school?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ui-btn ui-btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </section>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .detail-card, .danger-panel { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; gap: 14px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p, .danger-panel p { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; gap: 8px; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.ui-btn-danger { background: #b91c1c; color: #fff; }
.detail-grid { display: grid; gap: 14px; }
.detail-title { border-bottom: 1px solid #e5e7eb; color: #172033; font-weight: 800; padding: 13px 16px; }
.detail-title i { color: #123d35; margin-right: 8px; }
.info-grid { display: grid; gap: 12px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); padding: 16px; }
.info-item { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; padding: 12px; }
.info-item.wide { grid-column: 1 / -1; }
.info-item span { color: #6b7280; display: block; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.info-item strong { color: #172033; display: block; margin-top: 4px; }
.danger-panel { align-items: center; display: flex; justify-content: space-between; padding: 16px; }
.danger-panel form { margin: 0; }
@media (max-width: 768px) { .page-panel, .danger-panel { align-items: flex-start; flex-direction: column; } }
</style>

<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
