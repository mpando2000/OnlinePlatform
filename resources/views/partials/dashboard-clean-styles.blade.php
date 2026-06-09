<style>
.dashboard-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .stat-card, .panel-card {
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
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.ui-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 36px;
    padding: 8px 12px;
}
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.stats-grid { display: grid; gap: 14px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 14px; }
.stat-card {
    align-items: center;
    color: #172033;
    display: flex;
    gap: 12px;
    min-height: 88px;
    padding: 14px;
}
.stat-card:hover { border-color: #123d35; color: #172033; text-decoration: none; }
.stat-card i {
    align-items: center;
    background: #ecfdf5;
    border-radius: 8px;
    color: #047857;
    display: flex;
    height: 42px;
    justify-content: center;
    width: 42px;
}
.stat-card strong { display: block; font-size: 24px; line-height: 1; }
.stat-card span { color: #6b7280; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.dashboard-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); margin-bottom: 14px; }
.panel-title {
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    padding: 13px 16px;
}
.panel-title strong { color: #172033; }
.panel-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.list-panel, .summary-list, .progress-list { display: grid; gap: 10px; padding: 16px; }
.list-row, .summary-row {
    align-items: center;
    background: #f8fafc;
    border: 1px solid #eef2f7;
    border-radius: 8px;
    color: #172033;
    display: flex;
    justify-content: space-between;
    gap: 12px;
    padding: 12px;
}
a.list-row:hover { border-color: #123d35; color: #172033; text-decoration: none; }
.list-row strong, .summary-row span { color: #172033; display: block; }
.list-row span { color: #6b7280; display: block; font-size: 12px; margin-top: 3px; }
.summary-row strong { color: #047857; font-size: 18px; }
.actions-grid { display: grid; gap: 10px; grid-template-columns: repeat(4, minmax(0, 1fr)); padding: 16px; }
.action-tile {
    align-items: center;
    background: #f8fafc;
    border: 1px solid #eef2f7;
    border-radius: 8px;
    color: #172033;
    display: flex;
    gap: 10px;
    min-height: 48px;
    padding: 12px;
}
.action-tile:hover { border-color: #123d35; color: #172033; text-decoration: none; }
.action-tile i { color: #123d35; }
.progress-row { display: grid; gap: 8px; }
.progress-meta { display: flex; justify-content: space-between; }
.progress-meta strong { color: #172033; }
.progress-meta span { color: #047857; font-weight: 800; }
.progress-track { background: #e5e7eb; border-radius: 999px; height: 8px; overflow: hidden; }
.progress-track div { background: #22c55e; height: 100%; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
@media (max-width: 1100px) { .stats-grid, .actions-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 800px) {
    .page-panel { align-items: flex-start; flex-direction: column; }
    .stats-grid, .dashboard-grid, .actions-grid { grid-template-columns: 1fr; }
}
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
