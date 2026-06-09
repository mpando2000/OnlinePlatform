<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .table-card, .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; gap: 14px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.promotion-grid { display: grid; gap: 14px; grid-template-columns: 340px minmax(0,1fr); }
.ui-btn, .icon-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 34px; padding: 8px 12px; }
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.form-card form { padding: 16px; }
.field { margin-bottom: 12px; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field select, .promotion-row select { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.clean-table td span, .promotion-row span { color: #6b7280; display: block; font-size: 12px; }
.row-actions { display: flex; gap: 6px; justify-content: flex-end; }
.row-actions form { margin: 0; }
.icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.icon-btn.danger { color: #b91c1c; }
.promotion-list { display: grid; gap: 10px; padding: 16px; }
.promotion-row { align-items: center; background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; display: grid; gap: 12px; grid-template-columns: 1fr 260px; padding: 12px; }
.form-actions, .pagination-wrap { padding: 0 16px 16px; }
.empty-cell, .empty-state { color: #6b7280; padding: 20px; text-align: center; }
@media (max-width: 900px) { .promotion-grid, .promotion-row { grid-template-columns: 1fr; } .page-panel { align-items: flex-start; flex-direction: column; } }
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
