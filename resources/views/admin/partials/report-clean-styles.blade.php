<style>
.admin-report-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .table-card, .stat-card {
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
    min-height: 34px;
    padding: 8px 12px;
}
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-soft { background: #eef2f7; color: #374151; }
.ui-btn-soft:hover { background: #e2e8f0; color: #172033; }
.stats-grid { display: grid; gap: 14px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 14px; }
.stat-card { align-items: center; display: flex; gap: 12px; min-height: 82px; padding: 14px; }
.stat-card i { align-items: center; background: #ecfdf5; border-radius: 8px; color: #047857; display: flex; height: 42px; justify-content: center; width: 42px; }
.stat-card strong { color: #172033; display: block; font-size: 22px; line-height: 1.1; }
.stat-card span { color: #6b7280; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.panel-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.panel-title strong { color: #172033; font-weight: 800; }
.panel-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.table-responsive { overflow-x: auto; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.clean-table td span { color: #6b7280; display: block; font-size: 12px; margin-top: 3px; }
.status-pill { background: #ecfdf5; border-radius: 999px; color: #047857; display: inline-block; font-size: 12px; font-weight: 800; padding: 5px 9px; }
.empty-cell { color: #6b7280 !important; text-align: center; }
@media (max-width: 1050px) { .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 780px) { .page-panel { align-items: flex-start; flex-direction: column; } .stats-grid { grid-template-columns: 1fr; } }
</style>
<script>
const adminReportFooterYear = document.getElementById("currentYear");
if (adminReportFooterYear) adminReportFooterYear.textContent = new Date().getFullYear();
</script>
