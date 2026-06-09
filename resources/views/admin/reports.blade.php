@extends('components.dashmaster')

@section('body')
<div class="content-wrapper reports-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-chart-bar"></i> Reports</h1>
                <p>Open system reports for users and classes.</p>
            </div>
        </div>

        <div class="report-grid">
            <a href="{{ route('admin.user.reports') }}" class="report-card">
                <i class="fas fa-users"></i>
                <strong>User Report</strong>
                <span>View registered users and account information.</span>
            </a>
            <a href="{{ route('admin.class.reports') }}" class="report-card">
                <i class="fas fa-chalkboard"></i>
                <strong>Class Report</strong>
                <span>View class records and related learning data.</span>
            </a>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.reports-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .report-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.report-grid { display: grid; gap: 14px; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }
.report-card { color: #172033; display: grid; gap: 8px; padding: 18px; }
.report-card:hover { border-color: #123d35; color: #172033; text-decoration: none; }
.report-card i { color: #123d35; font-size: 26px; }
.report-card strong { font-size: 18px; }
.report-card span { color: #6b7280; }
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
@endsection
