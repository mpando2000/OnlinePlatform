<style>
.admin-clean-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.page-panel, .table-card, .form-card, .stat-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.page-panel { align-items: center; display: flex; gap: 14px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.ui-btn, .icon-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 34px; padding: 8px 12px; }
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.stats-grid { display: grid; gap: 14px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 14px; }
.stat-card { padding: 14px; }
.stat-card span, .info-item span { color: #6b7280; display: block; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.stat-card strong { color: #172033; display: block; font-size: 24px; }
.table-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.table-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.clean-table td span { color: #6b7280; display: block; font-size: 12px; }
.row-actions { display: flex; gap: 6px; justify-content: flex-end; }
.row-actions form { margin: 0; }
.icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.icon-btn.danger { color: #b91c1c; }
.empty-cell, .empty-state { color: #6b7280; padding: 20px; text-align: center; }
.form-card { padding: 18px; }
.form-grid, .question-editor, .info-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
.field-wide { grid-column: 1 / -1; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input, .field select, .field textarea { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.field input:focus, .field select:focus, .field textarea:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.question-panel { border: 1px solid #e5e7eb; border-radius: 8px; margin-top: 16px; }
.question-editor { border-top: 1px solid #eef2f7; padding: 16px; position: relative; }
.question-list { display: grid; gap: 10px; padding: 16px; }
.question-card, .info-item { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; padding: 12px; }
.question-card strong, .info-item strong { color: #172033; display: block; }
.question-card span { color: #6b7280; font-size: 12px; }
.form-actions { display: flex; gap: 8px; margin-top: 16px; }
@media (max-width: 900px) { .stats-grid, .form-grid, .question-editor, .info-grid { grid-template-columns: 1fr; } .page-panel { align-items: flex-start; flex-direction: column; } }
</style>
<script>document.getElementById("currentYear").textContent = new Date().getFullYear();</script>
