<style>
.theme-toggle {
    align-items: center;
    background: transparent;
    border: 0;
    border-radius: 7px;
    color: #586174;
    display: inline-flex;
    gap: 7px;
    height: 38px;
    margin: 1px 3px;
    padding: 8px 11px !important;
}
.theme-toggle:hover, .theme-toggle:focus { background: #eef2f7; color: #165a4d; outline: 0; }
.theme-toggle .theme-icon-sun { display: none; }
.theme-toggle-label { font-size: 12px; font-weight: 800; white-space: nowrap; }

html.theme-dark { color-scheme: dark; }
html.theme-dark body { background: #0b1120; color: #d7deea; }
html.theme-dark .main-header { background: #111827 !important; border-color: #263244 !important; }
html.theme-dark .main-header .nav-link { color: #cbd5e1 !important; }
html.theme-dark .main-header .nav-link:hover { color: #5ee0bc !important; }
html.theme-dark .theme-toggle { color: #f7c65c !important; }
html.theme-dark .theme-toggle:hover, html.theme-dark .theme-toggle:focus { background: #1e293b; }
html.theme-dark .theme-toggle .theme-icon-moon { display: none; }
html.theme-dark .theme-toggle .theme-icon-sun { display: inline-block; }

html.theme-dark .content-wrapper,
html.theme-dark .profile-page,
html.theme-dark .user-view-page,
html.theme-dark .users-page,
html.theme-dark .form-page,
html.theme-dark .admin-dashboard,
html.theme-dark .student-page,
html.theme-dark .teacher-page { background: #0b1120 !important; color: #d7deea; }

html.theme-dark .profile-header,
html.theme-dark .profile-card,
html.theme-dark .profile-stat,
html.theme-dark .profile-hero,
html.theme-dark .user-page-header,
html.theme-dark .identity-card,
html.theme-dark .summary-card,
html.theme-dark .detail-card,
html.theme-dark .danger-panel,
html.theme-dark .users-header,
html.theme-dark .filter-panel,
html.theme-dark .users-table-panel,
html.theme-dark .page-panel,
html.theme-dark .panel-card,
html.theme-dark .form-header-panel,
html.theme-dark .form-card,
html.theme-dark .table-card,
html.theme-dark .info-panel,
html.theme-dark .stat-card,
html.theme-dark .admin-page-header {
    background: #111827 !important;
    border-color: #263244 !important;
    box-shadow: none !important;
}

html.theme-dark .profile-hero::before,
html.theme-dark .identity-accent { background: #32b797 !important; }

/* Dashboard statistics need explicit contrast because their page-level styles
   are loaded after the shared theme stylesheet. */
html.theme-dark .stat-card,
html.theme-dark a.stat-card { color: #edf2f7 !important; }
html.theme-dark .stat-card strong,
html.theme-dark .stat-card .stat-value { color: #f8fafc !important; }
html.theme-dark .stat-card span,
html.theme-dark .stat-card .stat-label { color: #a8b4c5 !important; }
html.theme-dark .stat-card .stat-link { color: #70d7bd !important; }
html.theme-dark .stat-card > i,
html.theme-dark .stat-card .stat-icon { background: #1e293b !important; color: #67d7bd !important; }
html.theme-dark .stat-card:hover { background: #162033 !important; border-color: #3a4a62 !important; color: #fff !important; }

/* User Management uses summary-card values without an inner wrapper. */
html.theme-dark .users-page .summary-card strong { color: #f8fafc !important; }
html.theme-dark .users-page .summary-card > span { color: #a8b4c5 !important; }
html.theme-dark .users-page .filter-field label { color: #b8c3d3 !important; }
html.theme-dark .users-page .table-header strong,
html.theme-dark .users-page .user-cell strong { color: #f1f5f9 !important; }
html.theme-dark .users-page .table-header { border-color: #334155 !important; }
html.theme-dark .users-page .table-header span { background: #1e293b !important; color: #cbd5e1 !important; }
html.theme-dark .users-page .users-btn-light { background: #e7edf5 !important; color: #263244 !important; }

html.theme-dark h1,
html.theme-dark h2,
html.theme-dark h3,
html.theme-dark h4,
html.theme-dark h5,
html.theme-dark h6,
html.theme-dark .profile-header h1,
html.theme-dark .user-page-header h1,
html.theme-dark .identity-copy h2,
html.theme-dark .hero-identity h2,
html.theme-dark .card-heading h3,
html.theme-dark .info-line strong,
html.theme-dark .detail-list strong,
html.theme-dark .summary-card div strong,
html.theme-dark .profile-stat strong,
html.theme-dark .timeline-item strong,
html.theme-dark .activity-item strong,
html.theme-dark .management-action,
html.theme-dark .users-table,
html.theme-dark .clean-table,
html.theme-dark .panel-title strong,
html.theme-dark .panel-header,
html.theme-dark .summary-item strong,
html.theme-dark .list-row strong,
html.theme-dark .summary-row span,
html.theme-dark .action-tile,
html.theme-dark .progress-meta strong { color: #edf2f7 !important; }

html.theme-dark p,
html.theme-dark small,
html.theme-dark .profile-header p,
html.theme-dark .user-page-header p,
html.theme-dark .hero-identity p,
html.theme-dark .card-heading p,
html.theme-dark .info-line span,
html.theme-dark .detail-list span,
html.theme-dark .timeline-item small,
html.theme-dark .activity-item span,
html.theme-dark .management-action small { color: #94a3b8 !important; }

html.theme-dark .panel,
html.theme-dark .list-row,
html.theme-dark .summary-row,
html.theme-dark .summary-item,
html.theme-dark .action-tile,
html.theme-dark .item-card,
html.theme-dark .list-card,
html.theme-dark .detail-row,
html.theme-dark .message-body {
    background: #111827 !important;
    border-color: #263244 !important;
}
html.theme-dark .panel-header,
html.theme-dark .panel-title { border-color: #263244 !important; }
html.theme-dark .list-row span,
html.theme-dark .panel-title span,
html.theme-dark .summary-item span { color: #94a3b8 !important; }
html.theme-dark .action-tile i { color: #67d7bd !important; }
html.theme-dark .progress-track { background: #263244 !important; }

html.theme-dark .field input,
html.theme-dark .field select,
html.theme-dark .form-control,
html.theme-dark input[type="text"],
html.theme-dark input[type="email"],
html.theme-dark input[type="password"],
html.theme-dark select,
html.theme-dark textarea {
    background: #0f172a !important;
    border-color: #334155 !important;
    color: #e5e7eb !important;
}
html.theme-dark input::placeholder, html.theme-dark textarea::placeholder { color: #64748b; }

html.theme-dark .users-table thead th,
html.theme-dark .clean-table thead th { background: #172033 !important; border-color: #334155 !important; color: #dce5ef !important; }
html.theme-dark .users-table tbody td,
html.theme-dark .clean-table tbody td,
html.theme-dark .table td,
html.theme-dark .table th { border-color: #273449 !important; color: #d7deea; }
html.theme-dark .users-table tbody tr:hover,
html.theme-dark .clean-table tbody tr:hover { background: #162033 !important; }

html.theme-dark .profile-btn-light,
html.theme-dark .ui-btn-light,
html.theme-dark .ui-btn-soft { background: #1e293b !important; color: #d7deea !important; }
html.theme-dark .assignment-note,
html.theme-dark .info-item,
html.theme-dark .management-action > i:first-child,
html.theme-dark .activity-dot,
html.theme-dark .timeline-icon { background: #172033 !important; border-color: #2c3a50 !important; }
html.theme-dark .info-line,
html.theme-dark .detail-list > div,
html.theme-dark .activity-item + .activity-item,
html.theme-dark .timeline-item + .timeline-item,
html.theme-dark .management-action + .management-action,
html.theme-dark .card-heading { border-color: #263244 !important; }
html.theme-dark .main-footer { background: #111827 !important; border-color: #263244 !important; color: #94a3b8 !important; }

@media (max-width: 575px) { .theme-toggle-label { display: none; } .theme-toggle { padding: 8px 10px !important; } }
</style>
