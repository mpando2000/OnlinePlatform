<style>
.admin-clean-page, .form-page { background: #f5f7fb; min-height: 100vh; }
.page-shell, .form-shell { padding: 18px; }
.form-shell { max-width: 960px; }
.page-panel, .table-card, .form-header-panel, .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel, .form-header-panel { align-items: center; display: flex; gap: 14px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1, .form-header-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i, .form-header-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p, .form-header-panel p, .muted { color: #6b7280; margin: 4px 0 0; }
.ui-btn, .icon-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 34px; padding: 8px 12px; }
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.thumb { border-radius: 6px; height: 58px; object-fit: cover; width: 96px; }
.row-actions { display: flex; gap: 6px; justify-content: flex-end; }
.row-actions form { margin: 0; }
.icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.icon-btn.danger { color: #b91c1c; }
.status-pill { border-radius: 999px; display: inline-block; font-size: 12px; font-weight: 800; padding: 5px 9px; }
.status-active { background: #ecfdf5; color: #047857; }
.status-inactive { background: #f3f4f6; color: #4b5563; }
.empty-cell { color: #6b7280; text-align: center; }
.form-card { padding: 18px; }
.form-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
.field-wide { grid-column: 1 / -1; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input, .field textarea { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.field input:focus, .field textarea:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.check-field { align-items: end; display: flex; }
.check-field input { margin-right: 8px; min-height: auto; width: auto; }
.form-actions { display: flex; gap: 8px; margin-top: 18px; }
.preview-image { border-radius: 8px; display: block; height: 180px; margin-bottom: 16px; object-fit: cover; width: 100%; }
@media (max-width: 768px) { .page-panel, .form-header-panel { align-items: flex-start; flex-direction: column; } .form-grid { grid-template-columns: 1fr; } }
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
